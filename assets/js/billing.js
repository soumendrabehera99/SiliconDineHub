document.addEventListener("DOMContentLoaded", function () {
  let windowHeight = window.innerHeight;
  document.querySelector(".table-body-wrapper").style.maxHeight =
    windowHeight - 300 + "px";

  let fetchedData = [];
  let fromDate = "";
  let toDate = "";

  $("#generateBtn").on("click", function () {
    fromDate = $("#fromDate").val();
    toDate = $("#toDate").val();

    if (fromDate && toDate) {
      $.ajax({
        url: "../dbFunctions/orderAjax.php",
        type: "POST",
        data: { operation: "fetchBills", fromDate: fromDate, toDate: toDate },
        dataType: "json",
        beforeSend: function () {
          Swal.fire({
            title: "Generating Bill...",
            text: "Please wait",
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });
        },
        success: function (data) {
          Swal.close();
          if (data.error) {
            Swal.fire("Error", data.error, "error");
          } else {
            fetchedData = data; // Save for export
            let tableBody = "";
            if (data.length === 0) {
              tableBody = `<tr><td colspan="4">No records found for selected dates</td></tr>`;
            } else {
              data.forEach((row, index) => {
                tableBody += `
                  <tr>
                    <td>${index + 1}</td>
                    <td>${row.sic}</td>
                    <td>${row.name}</td>
                    <td>₹${parseFloat(row.totalAmount).toFixed(2)}</td>
                  </tr>`;
              });
            }
            $("#studentBillTableBody").html(tableBody);

            if (data.length > 0) {
              $("#exportBtn").show();
            } else {
              $("#exportBtn").hide();
            }
          }
        },
        error: function () {
          Swal.fire(
            "Error",
            "Something went wrong while fetching bills.",
            "error"
          );
        },
      });
    } else {
      Swal.fire("Warning", "Please select both From and To dates.", "warning");
    }
  });

  document.getElementById("exportBtn").addEventListener("click", function () {
    fromDate = document.getElementById("fromDate").value;
    toDate = document.getElementById("toDate").value;
    const table = document.querySelector(".table-body-wrapper table");
    if (!table) {
      Swal.fire({
        icon: "warning",
        title: "No data to export!",
        text: "Please generate the report first.",
      });
      return;
    }

    const wb = XLSX.utils.book_new();

    const heading = [
      [`Student Bills Report (From ${fromDate} To ${toDate})`],
      [],
      ["#", "SIC", "Name", "Total Amount (₹)"],
    ];

    const tableRows = [];
    document
      .querySelectorAll("#studentBillTableBody tr")
      .forEach((row, index) => {
        const rowData = [
          index + 1,
          row.cells[1]?.innerText || "",
          row.cells[2]?.innerText || "",
          row.cells[3]?.innerText || "",
        ];
        tableRows.push(rowData);
      });

    const finalData = heading.concat(tableRows);
    const ws = XLSX.utils.aoa_to_sheet(finalData);

    XLSX.utils.book_append_sheet(wb, ws, "Student Bills");

    const fileName = `StudentBills_${fromDate}_to_${toDate}.xlsx`;

    XLSX.writeFile(wb, fileName);

    Swal.fire({
      icon: "success",
      title: "Exported!",
      text: "Excel file downloaded successfully.",
      timer: 1500,
      showConfirmButton: false,
    });
  });

  document.getElementById("searchInput").addEventListener("keyup", function () {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll("#studentBillTableBody tr");

    tableRows.forEach((row) => {
      const sic = row.cells[1]?.textContent.toLowerCase(); // SIC column
      const name = row.cells[2]?.textContent.toLowerCase(); // Name column

      if (sic.includes(searchTerm) || name.includes(searchTerm)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
});
