<?php
/**
 * 管理画面で保存したSEO設定を、テンプレートの既定値より優先する。
 * 未入力時は既存の表示を維持し、canonicalの出力処理は変更しない。
 */
defined('ABSPATH') || exit;

function ts_get_seo_settings_post_id()
{
  if (is_admin() || is_search() || is_404()) {
    return 0;
  }

  if (is_singular()) {
    return (int) get_queried_object_id();
  }

  // 「投稿ページ」に指定した固定ページは is_singular() にならない。
  if (is_home() && get_option('show_on_front') === 'page') {
    return (int) get_option('page_for_posts');
  }

  // タームIDや一覧先頭の投稿IDを、固定ページの設定として使わない。
  return 0;
}

function ts_get_saved_page_seo_text($field)
{
  if (!in_array($field, array('title', 'description'), true) || ts_is_major_seo_plugin_active()) {
    return '';
  }

  $post_id = ts_get_seo_settings_post_id();
  if ($post_id <= 0) {
    return '';
  }

  $value = get_post_meta($post_id, '_ts_seo_' . $field, true);
  $limit = $field === 'title' ? 60 : 160;

  // 現在の管理画面が保存する値を優先。「0」も空欄として扱わない。
  if (is_string($value) && $value !== '') {
    return ts_normalize_meta_text($value, $limit);
  }
  if (!is_string($value)) {
    return '';
  }

  // 過去のメタキーで保存した設定との互換性を維持する。
  return $field === 'title'
    ? ts_get_custom_seo_title($post_id)
    : ts_get_custom_seo_description($post_id);
}

function ts_resolve_saved_seo_title($fallback)
{
  $saved = ts_get_saved_page_seo_text('title');
  return $saved !== '' ? $saved : $fallback;
}
// 各テンプレートの既定タイトル（優先度20）の後に適用する。
add_filter('pre_get_document_title', 'ts_resolve_saved_seo_title', 99);
add_filter('document_title', 'ts_resolve_saved_seo_title', 99);

function ts_resolve_saved_seo_description($fallback)
{
  $saved = ts_get_saved_page_seo_text('description');
  return $saved !== '' ? $saved : $fallback;
}

function ts_apply_saved_seo_robots($robots)
{
  if (ts_is_major_seo_plugin_active()) {
    return $robots;
  }

  $post_id = ts_get_seo_settings_post_id();
  if ($post_id > 0 && get_post_meta($post_id, '_ts_seo_noindex', true) === '1') {
    unset($robots['index']);
    $robots['noindex'] = true;
  }

  // サンクスページやサイト全体の既存noindex・nofollowは解除しない。
  return $robots;
}
add_filter('wp_robots', 'ts_apply_saved_seo_robots', 99);

function ts_output_thanks_seo_description()
{
  if (!is_page() || !in_array(get_page_template_slug(), array(
    'airconchangelp_thanks.php',
    'airconcleaninglp_thanks.php',
    'airconshuuri_thanks.php',
  ), true)) {
    return;
  }

  // 共通headerを使わないサンクスページは、入力がある場合だけ出力する。
  $description = ts_resolve_saved_seo_description('');
  if ($description !== '') {
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
  }
}
add_action('wp_head', 'ts_output_thanks_seo_description', 5);