$(document).ready(function () {
  $("#updateStudentStatusForm").submit(function (e) {
    e.preventDefault();
    let studentId = $("#updateStudentIdInput").val();
    let studentStatus = $("#updateStudentStatusInput").val();
    $.ajax({
      url: "../dbFunctions/studentAjax.php",
      method: "POST",
      data: {
        id: studentId,
        status: studentStatus,
        operation: "studentStatusUpdate",
      },
      success: function (response) {
        response = response.trim();
        if (response === "success") {
          toastr.success("Status Updated Successfully");
          $("#updateStudentStatusForm").trigger("reset");
          $("#updateStatusStudentModal").modal("toggle");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.warning("Already Updated");
        }
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("searchInput").addEventListener("input", function () {
    var searchQuery = this.value.toLowerCase();
    var tableRows = document.querySelectorAll("#myTable tbody tr"); // Get all table rows

    tableRows.forEach(function (row) {
      var sic = row.querySelector(".sic").textContent.toLowerCase();
      var name = row.querySelector(".name").textContent.toLowerCase();

      if (sic.includes(searchQuery) || name.includes(searchQuery)) {
        row.style.display = ""; // Show the row
      } else {
        row.style.display = "none"; // Hide the row
      }
    });
  });

  document.querySelectorAll(".statusUpdateBtn").forEach((btn) => {
    btn.addEventListener("click", function () {
      let studentId = this.getAttribute("data-id");
      let studentSic = this.getAttribute("data-sic");
      let studentStatus = this.getAttribute("data-status") == 1 ? 0 : 1;
      let dataName = this.getAttribute("data-name");
      document.querySelector("#updateStudentName").innerText = dataName;
      document.querySelector("#updateStudentIdInput").value = studentId;
      document.querySelector("#updateStudentSic").innerText = studentSic;
      document.querySelector("#updateStudentStatusInput").value = studentStatus;
      document.querySelector("#updateStudentStatus").innerText =
        studentStatus == 1 ? "Active" : "Block";
    });
  });
});
