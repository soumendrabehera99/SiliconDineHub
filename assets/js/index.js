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
    data: { operation: "fetchLatestAnnouncement01" },
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
      if (!response || response.error) {
        $("#announcementContent").html(
          `<p class="text-muted">No announcements available.</p>`
        );
        return;
      }

      let content = "";
      response.forEach((item) => {
        content += `
          <div class="mb-3 p-3 shadow-sm bg-light rounded announcement-card" style="background: linear-gradient(135deg, #ffd700, #ffa500); color: #000;">
            <h5 class="fw-bold">${item.title}</h5>
            <p class="mb-1">${item.message}</p>
            <p class="mb-1">Till: ${new Date(item.to_date).toLocaleDateString(
              "en-GB",
              { day: "numeric", month: "long", year: "numeric" }
            )}</p>
          </div>`;
      });
      $("#announcementContent").html(content);
    },
  });

  $.ajax({
    url: "./dbFunctions/feedbackAjax.php",
    method: "GET",
    data: { operation: "fetchFeedBack" },
    dataType: "json",
    success: function (response) {
      // console.log(response);
      if (response.success) {
        const feedback = response.data;
        const container = $("#feedback-carousel");
        let html = "";

        for (let i = 0; i < feedback.length; i += 2) {
          html += `<div class="carousel-item ${i === 0 ? "active" : ""}">
                            <div class="row g-2">`;

          for (let j = i; j < i + 2 && j < feedback.length; j++) {
            html += `<div class="col-md-6">
                                <div class="text-white p-3 bg-dark rounded-4">
                                    <p class="text-truncate-2">${feedback[j].feedback_text}</p>
                                    <p>${feedback[j].feedback_type} : ${feedback[j].rating}/5</p>
                                    <h4>${feedback[j].student_name}</h4>
                                </div>
                            </div>`;
          }

          html += `</div></div>`;
        }

        container.html(html);
      } else {
        console.error(response.error);
        alert("Error: " + response.error);
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX error:", error);
      alert("Something went wrong. Please try again later.");
    },
  });
  $.ajax({
    url: "./dbFunctions/announcementDb.php",
    method: "POST",
    data: { operation: "fetch" },
    dataType: "json",
    success: function (response) {
      if (!response || response.length === 0) {
        $("#fetchAllAnnouncements").html(
          `<p class="text-muted">No announcements available.</p>`
        );
        return;
      }

      let content = "";
      let count = 1;
      response.forEach((item) => {
        content += `
          <div class="mb-3 p-3 shadow-sm bg-light rounded announcement-card" style="background: linear-gradient(135deg, #ffd700, #ffa500); color: #000;">
            <div class="row w-100">
              <div class="col-12 col-md-8">
                <h5 class="fw-bold">${count++ + ". " + item.title}</h5>
                <p class="mb-1" style="text-align: justify;">${item.message}</p>
              </div>
              <div class="col-12 col-md-4 text-md-end mt-2 mt-md-0">
                <p class="mb-1">From: ${new Date(
                  item.from_date
                ).toLocaleDateString("en-GB", {
                  day: "numeric",
                  month: "long",
                  year: "numeric",
                })}</p>
                <p class="mb-1">To: ${new Date(item.to_date).toLocaleDateString(
                  "en-GB",
                  { day: "numeric", month: "long", year: "numeric" }
                )}</p>
              </div>
            </div>
          </div>`;
      });

      $("#fetchAllAnnouncements").html(content);
    },
    error: function () {
      $("#fetchAllAnnouncements").html(
        `<p class="text-danger">Failed to load announcements. Please try again later.</p>`
      );
    },
  });
});
