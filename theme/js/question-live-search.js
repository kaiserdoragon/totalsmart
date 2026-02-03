document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('js-question-search');
    const list = document.getElementById('js-question-results');
    const pagination = document.querySelector('.pagination');

    if (!input || !list) return;
    if (typeof QuestionSearch === 'undefined') {
        console.error('[live-search] QuestionSearch is undefined (wp_localize_script not output)');
        return;
    }

    const initialHTML = list.innerHTML;
    const minLen = Number(QuestionSearch.minLen || 1);

    let timer = null;
    let controller = null;
    let isComposing = false;
    let lastQuery = null;

    // 検索結果のJSキャッシュ（戻る入力が爆速になります）
    const cache = new Map();

    function setPaginationVisible(visible) {
        if (!pagination) return;
        pagination.style.display = visible ? '' : 'none';
    }

    function debounce(fn, ms = 150) {
        return (q) => {
            clearTimeout(timer);
            timer = setTimeout(() => fn(q), ms);
        };
    }

    async function request(keyword) {
        const q = (keyword || '').trim();

        // 0〜(minLen-1) は初期表示へ戻す
        if (q.length < minLen) {
            lastQuery = null;
            list.innerHTML = initialHTML;
            setPaginationVisible(true);
            return;
        }

        if (q === lastQuery) return;
        lastQuery = q;

        setPaginationVisible(false);

        const cacheKey = `${QuestionSearch.term || ''}|${q}`;
        if (cache.has(cacheKey)) {
            list.innerHTML = cache.get(cacheKey);
            return;
        }

        if (controller) controller.abort();
        controller = new AbortController();

        const fd = new FormData();
        fd.append('action', 'question_live_search');
        fd.append('nonce', QuestionSearch.nonce);
        fd.append('keyword', q);
        fd.append('term', QuestionSearch.term || '');

        const res = await fetch(QuestionSearch.ajaxurl, {
            method: 'POST',
            credentials: 'same-origin',
            body: fd,
            signal: controller.signal
        });

        const text = await res.text();

        if (!res.ok) {
            console.error('[live-search] HTTP error', res.status, text);
            return;
        }

        let json;
        try {
            json = JSON.parse(text);
        } catch (e) {
            console.error('[live-search] Non-JSON response', res.status, text);
            return;
        }

        if (json.success && json.data && typeof json.data.html === 'string') {
            cache.set(cacheKey, json.data.html);
            list.innerHTML = json.data.html;
        } else {
            console.error('[live-search] JSON error response', json);
        }
    }

    const run = debounce((q) => {
        request(q).catch((err) => {
            if (err && err.name === 'AbortError') return;
            console.error('[live-search] fetch error', err);
        });
    }, 150);

    input.addEventListener('compositionstart', () => { isComposing = true; });
    input.addEventListener('compositionend', () => {
        isComposing = false;
        run(input.value);
    });

    // 入力ごとに発火（リアルタイムの本体）
    input.addEventListener('input', (e) => {
        // IME変換中は確定前の value が不安定なことがあるのでスキップ :contentReference[oaicite:12]{index=12}
        if (isComposing || e.isComposing) return;
        run(input.value);
    });
});
