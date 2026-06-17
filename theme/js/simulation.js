(function () {
  "use strict";

  var unitIdCounter = 0;

  var ageFactors = {
    before1999: 2.2,
    "2000-2009": 1.9,
    "2010-2014": 1.65,
    "2015-2019": 1.35,
    "2020-2024": 1.15,
    unknown: 1.8,
  };

  var baseKwByHp = {
    1.5: 0.7,
    1.8: 0.85,
    2: 0.95,
    2.3: 1.0,
    2.5: 1.15,
    3: 1.45,
    3.5: 1.725,
    4: 2.0,
    5: 2.5,
    6: 3.0,
    8: 4.0,
    10: 5.0,
    12: 6.0,
  };

  var newBasisMaster = [
    { hp: 1.5, kw: 0.65 },
    { hp: 1.8, kw: 0.8 },
    { hp: 2.0, kw: 0.9 },
    { hp: 2.5, kw: 1.05 },
    { hp: 3.0, kw: 1.3 },
    { hp: 4.0, kw: 1.85 },
    { hp: 5.0, kw: 2.3 },
    { hp: 6.0, kw: 2.85 },
    { hp: 8.0, kw: 4.0 },
    { hp: 10.0, kw: 5.0 },
    { hp: 12.0, kw: 6.0 },
  ];

  var hpOptions = [
    { value: "1.5", label: "1.5馬力" },
    { value: "1.8", label: "1.8馬力" },
    { value: "2", label: "2馬力" },
    { value: "2.3", label: "2.3馬力" },
    { value: "2.5", label: "2.5馬力" },
    { value: "3", label: "3馬力" },
    { value: "3.5", label: "3.5馬力" },
    { value: "4", label: "4馬力" },
    { value: "5", label: "5馬力" },
    { value: "6", label: "6馬力" },
    { value: "8", label: "8馬力" },
    { value: "10", label: "10馬力" },
    { value: "12", label: "12馬力" },
  ];

  var ageOptions = [
    { value: "before1999", label: "1999年以前" },
    { value: "2000-2009", label: "2000〜2009年" },
    { value: "2010-2014", label: "2010〜2014年" },
    { value: "2015-2019", label: "2015〜2019年" },
    { value: "2020-2024", label: "2020〜2024年" },
    { value: "unknown", label: "不明" },
  ];

  var defaultUnits = [
    {
      hp: "3",
      age: "2010-2014",
      hoursPerDay: 8,
      daysPerMonth: 22,
      monthsPerYear: 10,
    },
  ];

  var unitList = document.getElementById("unitList");
  var addUnitBtn = document.getElementById("addUnitBtn");
  var resetBtn = document.getElementById("resetBtn");
  var unitCalcToggle = document.getElementById("unitCalcToggle");
  var unitCalcPanel = document.getElementById("unitCalcPanel");
  var applyUnitPriceBtn = document.getElementById("applyUnitPriceBtn");
  var unitCalcResult = document.getElementById("unitCalcResult");
  var errorBox = document.getElementById("errorBox");

  function yen(value) {
    var n = Math.round(Number(value) || 0);
    return "¥" + n.toLocaleString("ja-JP");
  }

  function numberText(value, digit) {
    var n = Number(value) || 0;
    return n.toLocaleString("ja-JP", {
      minimumFractionDigits: digit || 0,
      maximumFractionDigits: digit || 0,
    });
  }

  function createOptionHtml(options, selectedValue) {
    return options
      .map(function (item) {
        var selected = String(item.value) === String(selectedValue) ? " selected" : "";
        return (
          '<option value="' +
          escapeHtml(item.value) +
          '"' +
          selected +
          ">" +
          escapeHtml(item.label) +
          "</option>"
        );
      })
      .join("");
  }

  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/\"/g, "&quot;")
      .replace(/'/g, "&#39;");
  }

  function addUnit(data) {
    unitIdCounter += 1;
    var id = "unit_" + unitIdCounter;
    var unit = data || {
      hp: "3",
      age: "2010-2014",
      hoursPerDay: 8,
      daysPerMonth: 22,
      monthsPerYear: 10,
    };

    var div = document.createElement("div");
    div.className = "unit-card";
    div.dataset.unitId = id;
    div.innerHTML =
      '<div class="unit-card-head">' +
      '<div class="unit-title">エアコン <span class="unit-number"></span></div>' +
      '<button class="small-btn danger-btn remove-unit" type="button">削除</button>' +
      "</div>" +
      '<div class="grid">' +
      '<div class="field">' +
      "<label>馬力</label>" +
      '<select class="hp">' +
      createOptionHtml(hpOptions, unit.hp) +
      "</select>" +
      "</div>" +
      '<div class="field">' +
      "<label>年式</label>" +
      '<select class="age">' +
      createOptionHtml(ageOptions, unit.age) +
      "</select>" +
      "</div>" +
      '<div class="field">' +
      "<label>1日の稼働時間</label>" +
      '<input class="hours-per-day" type="number" inputmode="decimal" min="0" max="24" step="0.5" value="' +
      escapeHtml(unit.hoursPerDay) +
      '">' +
      "</div>" +
      '<div class="field">' +
      "<label>月の稼働日数</label>" +
      '<input class="days-per-month" type="number" inputmode="numeric" min="0" max="31" step="1" value="' +
      escapeHtml(unit.daysPerMonth) +
      '">' +
      "</div>" +
      '<div class="field">' +
      "<label>年間の稼働月数</label>" +
      '<input class="months-per-year" type="number" inputmode="numeric" min="0" max="12" step="1" value="' +
      escapeHtml(unit.monthsPerYear) +
      '">' +
      "</div>" +
      "</div>";

    unitList.appendChild(div);
    refreshUnitNumbers();
  }

  function refreshUnitNumbers() {
    var cards = getUnitCards();
    cards.forEach(function (card, index) {
      card.querySelector(".unit-number").textContent = String(index + 1);
      var removeBtn = card.querySelector(".remove-unit");
      removeBtn.style.display = cards.length <= 1 ? "none" : "inline-block";
    });
  }

  function getUnitCards() {
    return Array.prototype.slice.call(unitList.querySelectorAll(".unit-card"));
  }

  function showError(messages) {
    var list = Array.isArray(messages) ? messages : [messages];
    list = list.filter(function (message) {
      return String(message || "").trim() !== "";
    });

    if (!list.length) {
      clearError();
      return;
    }

    if (list.length === 1) {
      errorBox.textContent = list[0];
    } else {
      errorBox.innerHTML =
        "<ul>" +
        list
          .map(function (message) {
            return "<li>" + escapeHtml(message) + "</li>";
          })
          .join("") +
        "</ul>";
    }

    errorBox.classList.add("show");
  }

  function clearError() {
    errorBox.textContent = "";
    errorBox.classList.remove("show");
  }

  function getNumberFromCard(card, selector) {
    var value = Number(card.querySelector(selector).value);
    return isFinite(value) ? value : 0;
  }

  function getNewBasisKw(hp) {
    var target = Number(hp) || 0;
    for (var i = 0; i < newBasisMaster.length; i += 1) {
      if (newBasisMaster[i].hp >= target) {
        return newBasisMaster[i].kw;
      }
    }
    var last = newBasisMaster[newBasisMaster.length - 1];
    return last.kw * (target / last.hp);
  }

  function getBaseKw(hp) {
    var key = String(hp);
    if (baseKwByHp[key] != null) {
      return baseKwByHp[key];
    }
    return Number(hp) * 0.5;
  }

  function roundToTwo(value) {
    return Math.round(value * 100) / 100;
  }

  function parseNumberValue(value) {
    var trimmed = String(value == null ? "" : value).trim();
    if (trimmed === "") {
      return { raw: trimmed, number: NaN, empty: true, valid: false };
    }
    var number = Number(trimmed);
    return {
      raw: trimmed,
      number: number,
      empty: false,
      valid: isFinite(number),
    };
  }

  function roundCurrentBillInput() {
    var currentBillElement = document.getElementById("currentBill");
    if (!currentBillElement) {
      return;
    }

    var parsed = parseNumberValue(currentBillElement.value);
    if (parsed.empty || !parsed.valid || parsed.number < 0) {
      return;
    }

    var rounded = Math.round(parsed.number);
    if (String(currentBillElement.value).trim() !== String(rounded)) {
      currentBillElement.value = String(rounded);
    }
  }

  function collectInput() {
    var errors = [];
    var electricityUnitInput = parseNumberValue(document.getElementById("electricityUnit").value);
    var electricityUnit = electricityUnitInput.number;
    if (!electricityUnitInput.valid || electricityUnit <= 0) {
      errors.push("電気代単価は1以上の数値で入力してください。");
    }

    var currentBillElement = document.getElementById("currentBill");
    var currentBillInput = parseNumberValue(currentBillElement.value);
    var currentBill = 0;
    var currentBillEntered = false;
    if (!currentBillInput.empty) {
      if (!currentBillInput.valid || currentBillInput.number < 0) {
        errors.push("現在の月額電気代（任意）は、0以上の数値で入力してください。");
      } else {
        currentBill = currentBillInput.number;
        currentBillEntered = true;
      }
    }

    var cards = getUnitCards();
    if (!cards.length) {
      errors.push("エアコン情報を1台以上入力してください。");
    }

    var units = cards.map(function (card, index) {
      var hpInput = parseNumberValue(card.querySelector(".hp").value);
      var hp = hpInput.number;
      var age = card.querySelector(".age").value;
      var hoursInput = parseNumberValue(card.querySelector(".hours-per-day").value);
      var daysInput = parseNumberValue(card.querySelector(".days-per-month").value);
      var monthsInput = parseNumberValue(card.querySelector(".months-per-year").value);
      var hoursPerDay = hoursInput.number;
      var daysPerMonth = daysInput.number;
      var monthsPerYear = monthsInput.number;
      var unitLabel = "エアコン" + (index + 1);

      if (!hpInput.valid || hp <= 0) {
        errors.push(unitLabel + "の馬力を確認してください。");
      }
      if (!hoursInput.valid || hoursPerDay <= 0 || hoursPerDay > 24) {
        errors.push(unitLabel + "の1日の稼働時間は、0より大きく24以下で入力してください。");
      }
      if (
        !daysInput.valid ||
        daysPerMonth <= 0 ||
        daysPerMonth > 31 ||
        !Number.isInteger(daysPerMonth)
      ) {
        errors.push(unitLabel + "の月の稼働日数は、1〜31の整数で入力してください。");
      }
      if (
        !monthsInput.valid ||
        monthsPerYear <= 0 ||
        monthsPerYear > 12 ||
        !Number.isInteger(monthsPerYear)
      ) {
        errors.push(unitLabel + "の年間の稼働月数は、1〜12の整数で入力してください。");
      }

      return {
        index: index + 1,
        hp: hp,
        age: age,
        hoursPerDay: hoursPerDay,
        daysPerMonth: daysPerMonth,
        monthsPerYear: monthsPerYear,
      };
    });

    if (errors.length) {
      var validationError = new Error("入力内容を確認してください。");
      validationError.messages = errors;
      throw validationError;
    }

    return {
      electricityUnit: electricityUnit,
      makerName: document.getElementById("makerName").value.trim(),
      currentBill: currentBill,
      currentBillEntered: currentBillEntered,
      units: units,
    };
  }

  function calculate(input) {
    var rows = input.units.map(function (unit) {
      var ageFactor = ageFactors[unit.age] || ageFactors.unknown;
      var baseKw = getBaseKw(unit.hp);
      var currentKw = roundToTwo(baseKw * ageFactor);
      var newKw = roundToTwo(getNewBasisKw(unit.hp));
      var annualHours = unit.hoursPerDay * unit.daysPerMonth * unit.monthsPerYear;
      var currentAnnual = currentKw * annualHours * input.electricityUnit;
      var newAnnual = newKw * annualHours * input.electricityUnit;
      var annualSavings = currentAnnual - newAnnual;

      return {
        index: unit.index,
        hp: unit.hp,
        currentKw: currentKw,
        newKw: newKw,
        annualHours: annualHours,
        currentAnnual: currentAnnual,
        newAnnual: newAnnual,
        annualSavings: annualSavings,
      };
    });

    var result = rows.reduce(
      function (sum, row) {
        sum.currentAnnual += row.currentAnnual;
        sum.newAnnual += row.newAnnual;
        sum.annualSavings += row.annualSavings;
        sum.annualHoursTotal += row.annualHours;
        return sum;
      },
      {
        currentAnnual: 0,
        newAnnual: 0,
        annualSavings: 0,
        annualHoursTotal: 0,
      }
    );

    result.monthlySavings = result.annualSavings / 12;
    result.tenYearSavings = result.annualSavings * 10;
    result.savingRate =
      result.currentAnnual > 0 ? (result.annualSavings / result.currentAnnual) * 100 : 0;
    result.currentBill = input.currentBill;
    result.currentBillEntered = input.currentBillEntered;
    result.rows = rows;
    result.unitCount = rows.length;
    return result;
  }

  function setTextIfExists(id, text) {
    var element = document.getElementById(id);
    if (element) {
      element.textContent = text;
    }
  }

  function setWidthIfExists(id, width) {
    var element = document.getElementById(id);
    if (element) {
      element.style.width = width;
    }
  }

  function renderInvalidResult(messages) {
    var results = document.getElementById("results");
    var contactCta = document.getElementById("contactCta");
    var resultErrorState = document.getElementById("resultErrorState");

    if (results) {
      results.classList.add("show");
      results.classList.add("has-error");
    }
    if (contactCta) {
      contactCta.classList.remove("show");
    }
    if (resultErrorState) {
      resultErrorState.textContent =
        "入力内容にエラーがあります。上の赤い警告を確認し、エラーを修正してください。修正後に自動で再計算します。";
      resultErrorState.classList.add("show");
    }

    setTextIfExists("monthlySavings", "入力内容を修正してください");
    setTextIfExists("annualSavings", "—");
    setTextIfExists("tenYearSavings", "—");
    setTextIfExists("currentAnnual", "—");
    setTextIfExists("newAnnual", "—");
    setTextIfExists("savingRate", "—");
    setTextIfExists("annualHoursTotal", "—");
    setTextIfExists("unitCount", getUnitCards().length + "台");
    setTextIfExists("currentBarValue", "—");
    setTextIfExists("newBarValue", "—");
    setWidthIfExists("currentBar", "0%");
    setWidthIfExists("newBar", "0%");

    var currentBillMetric = document.getElementById("currentBillMetric");
    if (currentBillMetric) {
      currentBillMetric.classList.add("is-hidden");
    }

    var heroResultStatus = document.getElementById("heroResultStatus");
    var heroMonthlySavingsPreview = document.getElementById("heroMonthlySavingsPreview");
    var heroResultNote = document.getElementById("heroResultNote");
    if (heroResultStatus && heroMonthlySavingsPreview && heroResultNote) {
      heroResultStatus.textContent = "入力内容を確認してください";
      heroMonthlySavingsPreview.textContent = "計算を停止中";
      heroResultNote.textContent =
        "赤い警告の項目を修正すると、シミュレーション結果が自動で更新されます。";
    }
    setWidthIfExists("heroCurrentMiniBar", "0%");
    setWidthIfExists("heroNewMiniBar", "0%");

    var detailRows = document.getElementById("detailRows");
    if (detailRows) {
      detailRows.innerHTML =
        '<tr><td colspan="5">入力内容にエラーがあります。上の赤い警告を修正してください。</td></tr>';
    }
  }

  function renderResult(result) {
    var results = document.getElementById("results");
    var resultErrorState = document.getElementById("resultErrorState");
    if (results) {
      results.classList.remove("has-error");
    }
    if (resultErrorState) {
      resultErrorState.textContent = "";
      resultErrorState.classList.remove("show");
    }

    document.getElementById("annualSavings").textContent = yen(result.annualSavings);
    document.getElementById("monthlySavings").textContent = yen(result.monthlySavings);
    document.getElementById("currentAnnual").textContent = yen(result.currentAnnual);
    document.getElementById("newAnnual").textContent = yen(result.newAnnual);
    document.getElementById("tenYearSavings").textContent = yen(result.tenYearSavings);
    document.getElementById("savingRate").textContent = numberText(result.savingRate, 1) + "%";
    document.getElementById("annualHoursTotal").textContent =
      numberText(result.annualHoursTotal, 0) + "h";
    document.getElementById("unitCount").textContent = result.unitCount + "台";

    var currentBillMetric = document.getElementById("currentBillMetric");
    var currentBillRounded = document.getElementById("currentBillRounded");
    var currentBillImpact = document.getElementById("currentBillImpact");
    if (currentBillMetric && currentBillRounded && currentBillImpact) {
      if (result.currentBillEntered) {
        currentBillMetric.classList.remove("is-hidden");
        currentBillRounded.textContent = yen(result.currentBill);
        if (result.currentBill > 0) {
          var monthlyImpact = (result.monthlySavings / result.currentBill) * 100;
          currentBillImpact.textContent =
            "月間削減目安は、入力された月額電気代の約" +
            numberText(monthlyImpact, 1) +
            "%相当です。";
        } else {
          currentBillImpact.textContent = "0円のため、月額電気代に対する比率は算出できません。";
        }
      } else {
        currentBillMetric.classList.add("is-hidden");
        currentBillRounded.textContent = "¥0";
        currentBillImpact.textContent =
          "入力された金額は、入力欄から離れた時に自動的に四捨五入されます。";
      }
    }

    var maxAnnual = Math.max(result.currentAnnual, result.newAnnual, 1);
    var currentPercent = Math.max(2, Math.min(100, (result.currentAnnual / maxAnnual) * 100));
    var newPercent = Math.max(2, Math.min(100, (result.newAnnual / maxAnnual) * 100));
    document.getElementById("currentBar").style.width = currentPercent + "%";
    document.getElementById("newBar").style.width = newPercent + "%";
    document.getElementById("currentBarValue").textContent = yen(result.currentAnnual);
    document.getElementById("newBarValue").textContent = yen(result.newAnnual);

    var heroResultStatus = document.getElementById("heroResultStatus");
    var heroMonthlySavingsPreview = document.getElementById("heroMonthlySavingsPreview");
    var heroResultNote = document.getElementById("heroResultNote");
    var heroCurrentMiniBar = document.getElementById("heroCurrentMiniBar");
    var heroNewMiniBar = document.getElementById("heroNewMiniBar");
    if (
      heroResultStatus &&
      heroMonthlySavingsPreview &&
      heroResultNote &&
      heroCurrentMiniBar &&
      heroNewMiniBar
    ) {
      heroResultStatus.textContent = "今回のシミュレーション結果";
      heroMonthlySavingsPreview.textContent = yen(result.monthlySavings) + " / 月";
      heroResultNote.textContent =
        "現在 " +
        yen(result.currentAnnual / 12) +
        "/月 → 更新後 " +
        yen(result.newAnnual / 12) +
        "/月 の概算です。";
      heroCurrentMiniBar.style.width = currentPercent + "%";
      heroNewMiniBar.style.width = newPercent + "%";
    }

    var detailRows = document.getElementById("detailRows");
    detailRows.innerHTML = result.rows
      .map(function (row) {
        return (
          "<tr>" +
          "<td>エアコン" +
          row.index +
          "（" +
          row.hp +
          "馬力）</td>" +
          '<td class="number">' +
          numberText(row.currentKw, 2) +
          " kW</td>" +
          '<td class="number">' +
          numberText(row.newKw, 2) +
          " kW</td>" +
          '<td class="number">' +
          numberText(row.annualHours, 0) +
          " h</td>" +
          '<td class="number">' +
          yen(row.annualSavings) +
          "</td>" +
          "</tr>"
        );
      })
      .join("");

    document.getElementById("results").classList.add("show");
    document.getElementById("contactCta").classList.add("show");
  }

  function toggleUnitCalculator() {
    var isOpen = unitCalcPanel.classList.toggle("show");
    unitCalcToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    unitCalcToggle.textContent = isOpen
      ? "− 電気料金明細から単価を計算する"
      : "＋ 電気料金明細から単価を計算する";
  }

  function applyUnitPriceFromBill() {
    var amount = Number(document.getElementById("billAmount").value);
    var kwh = Number(document.getElementById("billKwh").value);

    if (!isFinite(amount) || amount <= 0 || !isFinite(kwh) || kwh <= 0) {
      unitCalcResult.textContent = "請求金額と使用量を入力してください。";
      unitCalcResult.classList.remove("is-success");
      unitCalcResult.classList.add("is-error");
      return;
    }

    var unitPrice = Math.round((amount / kwh) * 10) / 10;
    document.getElementById("electricityUnit").value = String(unitPrice);
    unitCalcResult.textContent = unitPrice.toLocaleString("ja-JP") + "円/kWhを反映しました。";
    unitCalcResult.classList.remove("is-error");
    unitCalcResult.classList.add("is-success");
    updateRealtimeResult();
  }

  function resetAll() {
    unitIdCounter = 0;
    unitList.innerHTML = "";
    defaultUnits.forEach(function (unit) {
      addUnit(unit);
    });
    document.getElementById("electricityUnit").value = "30";
    document.getElementById("billAmount").value = "";
    document.getElementById("billKwh").value = "";
    unitCalcResult.textContent = "";
    unitCalcResult.classList.remove("is-error");
    unitCalcResult.classList.remove("is-success");
    unitCalcPanel.classList.remove("show");
    unitCalcToggle.setAttribute("aria-expanded", "false");
    unitCalcToggle.textContent = "＋ 電気料金明細から単価を計算する";
    document.getElementById("makerName").value = "";
    document.getElementById("currentBill").value = "";
    clearError();
    updateRealtimeResult();
  }

  function updateRealtimeResult() {
    try {
      clearError();
      var input = collectInput();
      var result = calculate(input);
      renderResult(result);
    } catch (error) {
      var messages = error.messages || error.message || "入力内容を確認してください。";
      showError(messages);
      renderInvalidResult(messages);
    }
  }

  addUnitBtn.addEventListener("click", function () {
    addUnit();
    updateRealtimeResult();
  });

  unitList.addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-unit")) {
      var card = event.target.closest(".unit-card");
      if (card && getUnitCards().length > 1) {
        card.parentNode.removeChild(card);
        refreshUnitNumbers();
        updateRealtimeResult();
      }
    }
  });

  unitCalcToggle.addEventListener("click", function () {
    toggleUnitCalculator();
  });

  applyUnitPriceBtn.addEventListener("click", function () {
    applyUnitPriceFromBill();
  });

  unitList.addEventListener("input", function () {
    updateRealtimeResult();
  });

  unitList.addEventListener("change", function () {
    updateRealtimeResult();
  });

  document.getElementById("electricityUnit").addEventListener("input", function () {
    updateRealtimeResult();
  });

  document.getElementById("electricityUnit").addEventListener("change", function () {
    updateRealtimeResult();
  });

  document.getElementById("currentBill").addEventListener("input", function () {
    updateRealtimeResult();
  });

  document.getElementById("currentBill").addEventListener("change", function () {
    updateRealtimeResult();
  });

  document.getElementById("currentBill").addEventListener("blur", function () {
    roundCurrentBillInput();
    updateRealtimeResult();
  });

  resetBtn.addEventListener("click", function () {
    resetAll();
  });

  resetAll();
})();
