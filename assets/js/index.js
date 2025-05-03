// Food
// Readmore/Readless toggle button
// if (strlen($desc) > 80) {
//     echo '<span class="short-text">' . substr($desc, 0, 80) . '...</span>';
//     echo '<span class="full-text" style="display: none;">' . $desc . '</span>';
// } else {
//     echo $desc;
// }
document.addEventListener("DOMContentLoaded", function () {
  // Initialize tooltips
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "3000",
  };

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

  // footer
  document.getElementById("displayYear").innerText = new Date().getFullYear();
});

window.onload = function () {
  setTimeout(() => {
    fetchStickyBox();
  }, 3000);
};

function fetchStickyBox() {
  $.ajax({
    url: "./dbFunctions/announcementDb.php",
    type: "POST",
    data: { operation: "fetchLatestAnnouncement" },
    dataType: "json",
    success: function (response) {
      if (!response || response.error) {
        return;
      }
      let box = document.getElementById("stickyBox");
      if (!box) return;

      document.getElementById("stickyTitle").innerText = response.title;
      document.getElementById("stickyMessage").innerText = response.message;

      box.classList.remove("d-none", "opacity-0");
      box.classList.add("d-block");
    },
  });
}

function closeStickyBox() {
  const box = document.getElementById("stickyBox");
  box.classList.add("opacity-0", "z-n1");
  setTimeout(() => {
    box.style.display = "none";
  }, 300);
}

$(document).ready(function () {
  $.ajax({
    url: "./dbFunctions/announcementDb.php",
    method: "POST",
    data: { operation: "fetchLatestAnnouncement" },
    dataType: "json",
    success: function (response) {
      // console.log(response);
      if (!response || response.error) {
        $("#announcementContent").html(
          `<p class="text-muted">No announcements available.</p>`
        );
        return;
      }

      let announcementContent = `
            <div class="mb-3 p-3 shadow-sm bg-light rounded" style="background: linear-gradient(135deg, #ffd700, #ffa500); color: #000;">
              <h5 class="fw-bold">${response.title}</h5>
              <p class="mb-1">${response.message}</p>
              <p class="text-muted small">
                From: ${response.from_date} To: ${response.to_date}
              </p>
            </div>`;
      $("#announcementContent").html(announcementContent);
    },
  });
});
