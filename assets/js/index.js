// Food
// Readmore/Readless toggle button
// if (strlen($desc) > 80) {
//     echo '<span class="short-text">' . substr($desc, 0, 80) . '...</span>';
//     echo '<span class="full-text" style="display: none;">' . $desc . '</span>';
// } else {
//     echo $desc;
// }
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".details").forEach(function (detail) {
    let shortText = detail.querySelector(".short-text");
    let fullText = detail.querySelector(".full-text");
    let readMoreLink = detail.querySelector(".read-more");

    if (readMoreLink) {
      readMoreLink.addEventListener("click", function () {
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
$(document).ready(function () {
  $(".search-Btn").click(function () {
    console.log("clicked");
    let searchQuery = $("#search").val().trim();
    window.location.href = `./foodPlp.php?search=${searchQuery}`;
  });

  $("#search").keypress(function (e) {
    if (e.which === 13) {
      let searchQuery = $(this).val().trim();
      window.location.href = `./foodPlp.php?search=${searchQuery}`;
    }
  });
});
