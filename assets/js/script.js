// Food
// Readmore/Readless toggle button
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.details').forEach(function (detail) {
      let shortText = detail.querySelector('.short-text');
      let fullText = detail.querySelector('.full-text');
      let readMoreLink = detail.querySelector('.read-more');

      if (readMoreLink) {
          readMoreLink.addEventListener('click', function () {
              if (fullText.style.display === "none") {
                  fullText.style.display = "inline";
                  shortText.style.display = "none";
                  readMoreLink.innerText = "Read Less";
              } else {
                  fullText.style.display = "none";
                  shortText.style.display = "inline";
                  readMoreLink.innerText = "Read More";
              }
          });
      }
  });
});