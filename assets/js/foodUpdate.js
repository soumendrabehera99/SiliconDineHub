$(document).ready(function () {
  $("#updateFood").submit(function (e) {
    e.preventDefault();

    let foodId = $("#foodId").val().trim();
    let foodName = $("#foodName").val().trim();
    let categoryID = $("#categoryName").val().trim();
    let foodDescription = $("#foodDescription").val().trim();
    let foodPrice = $("#foodPrice").val().trim();
    let foodStatus = $("#foodStatus").val().trim();

    let isValid = true;

    if (foodName === "") {
      toastr.error("foodName should not be blank");
      isValid = false;
    }
    if (categoryID === "") {
      toastr.error("category should not be blank");
      isValid = false;
    }
    if (foodDescription === "") {
      toastr.error("foodDescription should not be blank");
      isValid = false;
    }
    if (foodPrice === "") {
      toastr.error("foodPrice should not be blank");
      isValid = false;
    } else if (isNaN(foodPrice) || foodPrice <= 0) {
      toastr.error("foodPrice should be a valid +ve number");
      isValid = false;
    }
    if (foodStatus === "") {
      toastr.error("foodStatus should not be blank");
      isValid = false;
    }
    if (isValid) {
      // toastr.success("Form validated successfully");
      let formData = new FormData();
      formData.append("foodId", foodId);
      formData.append("foodName", foodName);
      formData.append("categoryID", categoryID);
      formData.append("foodDescription", foodDescription);
      formData.append("foodPrice", foodPrice);
      formData.append("foodStatus", foodStatus);
      formData.append("operation", "foodUpdate");
      $.ajax({
        url: "../dbFunctions/foodAjax.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "present") {
            toastr.success("No Changes Detected!!");
            $("#updateFoodBtn").attr("disabled", true);
            $("#editFoodBtn").attr("disabled", false);
          } else if (response.status === "success") {
            toastr.success("Food details updated successfully");
            setTimeout(() => location.reload(), 500);
          } else if (response.status === "error") {
            toastr.error("Facing Problem in Upadating the food");
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX error:", status, error);
          console.log("Response text:", xhr.responseText);
          toastr.error("Error submitting form: " + error);
        },
      });
    }
  });
});
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("editFoodBtn")
    .addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector("#foodName").removeAttribute("readonly");
      document.querySelector("#categoryName").removeAttribute("disabled");
      document.querySelector("#foodDescription").removeAttribute("readonly");
      document.querySelector("#foodPrice").removeAttribute("readonly");
      document.querySelector("#foodStatus").removeAttribute("disabled");
      document.querySelector("#updateFoodBtn").removeAttribute("disabled");
      document.querySelector("#editFoodBtn").setAttribute("disabled", true);
    });
});
