document.addEventListener("DOMContentLoaded", function () {
  // Search bar
  document.getElementById("searchInput").addEventListener("input", function () {
    let searchQuery = this.value.toLowerCase();
    let tableRows = document.querySelectorAll("#myTable tbody tr");

    tableRows.forEach((row) => {
      let sic = row.querySelector(".sic").textContent.toLowerCase();
      let email = row.querySelector(".email").textContent.toLowerCase();
      if (sic.includes(searchQuery) || email.includes(searchQuery)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
  // Delete the records using sweetalert
  document.querySelectorAll(".delete-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let recordId = this.getAttribute("data-id"); // Get the record ID
      let sic = this.getAttribute("data-sic"); // Get the record ID

      Swal.fire({
        title: `Are you sure want to delete ${sic}?`,
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          let formData = new FormData();
          formData.append("id", recordId);
          formData.append("operation", "deleteSicEmail");
          fetch("../dbFunctions/studentAjax.php", {
            method: "POST",
            body: formData, // Sending data as JSON
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                Swal.fire({
                  title: "Deleted!",
                  text: data.message,
                  icon: "success",
                  timer: 2000,
                  showConfirmButton: false,
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire("Error!", data.message, "error");
              }
            })
            .catch((error) => {
              Swal.fire("Error!", "Something went wrong.", "error");
            });
        }
      });
    });
  });

  //edit button modal fire
  document.querySelectorAll(".edit-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let seId = this.getAttribute("data-id");
      let email = this.getAttribute("data-email");
      let sic = this.getAttribute("data-sic");

      document.getElementById("editStudentSic").value = sic;
      document.getElementById("editSeId").value = seId;
      document.getElementById("editStudetEmail").value = email;
    });
  });
});

$("document").ready(function () {
  $("#editStudentSicEmail").submit(function (e) {
    e.preventDefault();
    let seId = $("#editSeId").val();
    let sic = $("#editStudentSic").val();
    let email = $("#editStudetEmail").val();

    let sicError = validateSIC(sic);
    if (sicError) {
      toastr.error(sicError);
      return;
    }

    let emailError = validateEmail(email, sic);
    if (emailError) {
      toastr.error(emailError);
      return;
    }

    $.ajax({
      url: "../dbFunctions/studentAjax.php",
      method: "POST",
      data: {
        id: seId,
        sic: sic.toUpperCase(),
        email: email.toLowerCase(),
        operation: "sicEmailUpdate",
      },
      success: function (response) {
        response = response.trim();
        if (response === "present") {
          toastr.error("Student details already exists!");
        } else if (response == "success") {
          toastr.success("Student details updated successfully");
          $("#editStudentSicEmail").trigger("reset");
          $("#editSicEmailModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.error("There is an error in update Student Details");
        } else {
          toastr.error("Unknown response.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed: ", status, error);
        toastr.error("An error occurred while processing your request.");
      },
    });
  });
});

// function for Sic Validation
function validateSIC(sic) {
  if (!sic) return "SIC is Missing.";
  if (sic.length !== 8) return "SIC must be exactly 8 characters long";

  let sicPattern = /^[0-9]{2}[a-z]{4}[0-9]{2}$/i; // Example: 23mmci48
  if (!sicPattern.test(sic)) return "SIC format is invalid (e.g., 23mmci48)";

  return null; // No errors
}

// function for Email Validation
function validateEmail(email, sic) {
  sic = sic.toLowerCase();
  email = email.toLowerCase();
  let emailPattern =
    /^[a-zA-Z0-9._%+-]{2,}\.\d{2}[a-zA-Z]{4}\d{2}@silicon\.ac\.in$/;
  if (!email) return "Email is Missing";
  if (!email.includes(sic)) return "Email does not match SIC No";
  if (!emailPattern.test(email)) return "Enter a valid email address";
  return null;
}
