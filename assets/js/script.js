document.querySelectorAll(".currentYear").forEach((el) => {
  el.textContent = new Date().getFullYear();
});
