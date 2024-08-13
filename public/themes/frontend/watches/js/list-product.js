// Range slider
const filterRangeSlider = document.querySelector(
  ".products-filter-item .products-range-slider"
);

const filterRangeSliderInputMin = document.querySelector(
  ".products-filter-item .products-range-slider-input .min"
);
const filterRangeSliderInputMax = document.querySelector(
  ".products-filter-item .products-range-slider-input .max"
);

rangeSlider(filterRangeSlider, {
  // min value
  min: 0,
  // max value
  max: 100,
  // step size
  step: 1,
  // set input value
  value: [0, 100],
  onInput: function (valueSet) {
    filterRangeSliderInputMin.value = valueSet[0];
    filterRangeSliderInputMax.value = valueSet[1];
  },
});

// Change range slider input value
const changeValue = () => {
  rangeSlider(filterRangeSlider).value([
    filterRangeSliderInputMin.value,
    filterRangeSliderInputMax.value,
  ]);
};

// Set default value input
filterRangeSliderInputMin.value = 0;
filterRangeSliderInputMax.value = 100;

// Toggle mobile filter
const openFilterButton = document.querySelector(".products-filter-toggle");

const closeFilterButton = document.querySelector(".products-filter-close");

const productFilterList = document.querySelector(".products-filter");

openFilterButton.addEventListener("click", () => {
  productFilterList.classList.add("active");
});

closeFilterButton.addEventListener("click", () => {
  productFilterList.classList.remove("active");
});

// clear all checkbox
const clearBtn = document.querySelectorAll(".clear-button");
Array.from(clearBtn).forEach((btn) => {
  btn.addEventListener("click", function () {
    checkList = this.parentElement.querySelectorAll('input[type="checkbox"]');
    Array.from(checkList).forEach((check) => {
      check.checked = false;
    });
  });
});
