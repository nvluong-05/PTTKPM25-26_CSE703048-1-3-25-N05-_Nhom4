document.addEventListener("DOMContentLoaded", function () {
  const radioInputs = document.querySelectorAll('input[type="radio"]');

  radioInputs.forEach((input) => {
    input.addEventListener("change", function () {
      document.querySelectorAll(".radio-checked").forEach((el) => {
        el.classList.add("hidden");
      });

      if (this.checked) {
        const checkedIndicator = this.parentElement.querySelector(".radio-checked");
        checkedIndicator.classList.remove("hidden");
      }
    });
  });
});
