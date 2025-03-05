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
document.addEventListener("DOMContentLoaded", function () {
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
});
