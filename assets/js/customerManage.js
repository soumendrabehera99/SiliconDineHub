$(document).ready(function () {
  $("#updateStudentStatusForm").submit(function (e) {
    e.preventDefault();
    let studentId = $("#updateStudentIdInput").val();
    let studentStatus = $("#updateStudentStatusInput").val();
    localStorage.setItem("searchTerm", $("#searchInput").val());
    console.log(localStorage.getItem("searchTerm"));
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
      let studentName = this.getAttribute("data-name");
      document.querySelector("#updateStudentName").innerText = studentName;
      document.querySelector("#updateStudentIdInput").value = studentId;
      document.querySelector("#updateStudentSic").innerText = studentSic;
      document.querySelector("#updateStudentStatusInput").value = studentStatus;
      document.querySelector("#updateStudentStatus").innerText =
        studentStatus == 1 ? "Active" : "Block";
    });
  });
  document.querySelectorAll(".viewBtn").forEach((btn) => {
    btn.addEventListener("click", function () {
      let studentId = this.getAttribute("data-id");
      let studentSic = this.getAttribute("data-sic");
      // let studentStatus = this.getAttribute("data-status") == 1 ? 0 : 1;
      let studentEmail = this.getAttribute("data-email");
      let studentName = this.getAttribute("data-name");
      let studentDob = this.getAttribute("data-date");
      document.querySelector("#viewStudentIdInput").value = studentId;
      document.querySelector("#viewStudentName").value = studentName;
      document.querySelector("#viewStudentEmail").value = studentEmail;
      document.querySelector("#viewStudentSic").value = studentSic;
      document.querySelector("#viewStudentDob").value = studentDob;
    });
  });
  document.querySelector("#editBtn").addEventListener("click", function () {
    document.querySelector("#editBtn").setAttribute("disabled", true);
    document.querySelector("#updateBtn").removeAttribute("disabled");
    document.querySelector("#viewStudentName").removeAttribute("disabled");
    // document.querySelector("#viewStudentEmail").removeAttribute("disabled");
    // document.querySelector("#viewStudentSic").removeAttribute("disabled");
    document.querySelector("#viewStudentDob").removeAttribute("disabled");
  });
  onDomReload();
});
function onDomReload() {
  $("#searchInput").val(localStorage.getItem("searchTerm"));
  localStorage.removeItem("searchTerm");
  localStorage.clear();
  let event = new CustomEvent("input");
  document.getElementById("searchInput").dispatchEvent(event);
}
