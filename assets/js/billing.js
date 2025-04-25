document.addEventListener("DOMContentLoaded", function () {
  $("#generateBtn").on("click", function () {
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();

    if (fromDate && toDate) {
      $.ajax({
        url: "getStudentBills.php",
        type: "POST",
        data: { fromDate, toDate },
        dataType: "json",
        success: function (data) {
          if (data.error) {
            $("#result").html(`<p style="color:red;">${data.error}</p>`);
          } else {
            let html =
              '<table border="1"><tr><th>SIC</th><th>Name</th><th>Total Amount</th></tr>';
            data.forEach((row) => {
              html += `<tr><td>${row.sic}</td><td>${row.name}</td><td>${row.totalAmount}</td></tr>`;
            });
            html += "</table>";
            $("#result").html(html);
          }
        },
        error: function () {
          $("#result").html('<p style="color:red;">AJAX error occurred.</p>');
        },
      });
    } else {
      toastr.warning("Please select both dates");
    }
  });
});
