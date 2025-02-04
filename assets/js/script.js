document.querySelectorAll(".currentYear").forEach((el) => {
  el.textContent = new Date().getFullYear();
});

document
  .querySelectorAll(".sidebar .dropdown-toggle")
  .forEach(function (dropdownToggle) {  
    dropdownToggle.addEventListener("click", function () {
      const icon = this.querySelector("i");
      if (icon.classList.contains("bi-chevron-right")) {
        icon.classList.remove("bi-chevron-right");
        icon.classList.add("bi-chevron-down");
      } else {
        icon.classList.remove("bi-chevron-down");
        icon.classList.add("bi-chevron-right");
      }
    });
});
