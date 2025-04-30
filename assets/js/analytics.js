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
  fetchTopSelling(7);
  fetchLeastSelling(7);

  $("#filterDuration").change(function () {
    const selected = $(this).val();
    const days = parseInt(selected.match(/\d+/)[0]);
    fetchTopSelling(days);
    fetchLeastSelling(days);
  });
});
