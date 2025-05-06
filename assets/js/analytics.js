$(document).ready(function () {
  function fetchTopSelling(days) {
    $.ajax({
      url: "../dbFunctions/orderAjax.php",
      method: "POST",
      data: {
        operation: "fetchTopSellingFood",
        days: days,
      },
      dataType: "json",
      success: function (data) {
        // console.log(data);

        let listHTML = "";
        if (data.length === 0) {
          listHTML =
            "<li class='list-group-item text-muted'>No data available</li>";
        } else {
          data.forEach((item) => {
            listHTML += `
                                <li class="list-group-item d-flex justify-content-between">
                                    ${item.name} <span class="badge bg-success">${item.totalSold}</span>
                                </li>
                            `;
          });
        }
        $("#topSellingList").html(listHTML);
        $("#topSellingDuration").text(`(Showing: Last ${days} Days)`);
      },
      error: function () {
        $("#topSellingList").html(
          "<li class='list-group-item text-danger'>Error loading data</li>"
        );
      },
    });
  }

  function fetchLeastSelling(days) {
    $.ajax({
      url: "../dbFunctions/orderAjax.php",
      method: "POST",
      data: {
        operation: "fetchLeastSellingFood",
        days: days,
      },
      dataType: "json",
      success: function (data) {
        // console.log(data);

        let listHTML = "";
        if (data.length === 0) {
          listHTML =
            "<li class='list-group-item text-muted'>No data available</li>";
        } else {
          data.forEach((item) => {
            listHTML += `
                        <li class="list-group-item d-flex justify-content-between">
                            ${item.name} <span class="badge bg-danger">${item.totalSold}</span>
                        </li>
                    `;
          });
        }
        $("#leastSellingList").html(listHTML);
        $("#leastSellingDuration").text(`(Showing: Last ${days} Days)`);
      },
    });
  }

  function fetchFeedbacks(days) {
    $.ajax({
      url: "../dbFunctions/feedbackAjax.php",
      method: "GET",
      data: {
        operation: "fetchanalyticsFeedBack",
        days: days,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (response.success) {
          const goodHTML = response.good
            .map(
              (f) => `
              <div class="mb-3 border-bottom pb-1">
                <strong>${f.student_name}</strong> - “${f.feedback_text}”
                <span class="badge ${
                  f.feedback_type === "Employee"
                    ? "bg-warning text-dark"
                    : "bg-primary"
                } ms-2">${f.feedback_type}</span>
              </div>
            `
            )
            .join("");

          const badHTML = response.bad
            .map(
              (f) => `
              <div class="mb-3 border-bottom pb-1 text-truncate-1">
                <strong>${f.student_name}</strong> - “${f.feedback_text}”
                <span class="badge bg-danger ms-2">${f.feedback_type}</span>
              </div>
            `
            )
            .join("");

          $("#goodFeedbacks").html(goodHTML || "<p>No data</p>");
          $("#badFeedbacks").html(badHTML || "<p>No data</p>");
          $("#goodFeedBackDuration").text(`(Showing: Last ${days} Days)`);
          $("#badFeedBackDuration").text(`(Showing: Last ${days} Days)`);
        } else {
          alert("Feedback fetch failed: " + response.error);
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX error: " + error);
      },
    });
  }

  fetchTopSelling(7);
  fetchLeastSelling(7);
  fetchFeedbacks(7);

  $("#filterDuration").change(function () {
    const selected = $(this).val();
    const days = parseInt(selected.match(/\d+/)[0]);
    fetchTopSelling(days);
    fetchLeastSelling(days);
    fetchFeedbacks(days);
  });
});
