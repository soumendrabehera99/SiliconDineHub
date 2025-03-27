$(document).ready(function () {
  $.ajax({
    url: "../dbFunctions/categoryAjax.php",
    method: "POST",
    data: { operation: "categoryGetAll" },
    dataType: "json",
    success: function (response) {
      if (response.error) {
        toastr.error(response.error);
        return;
      }
      if (
        !Array.isArray(response.categories) ||
        response.categories.length === 0
      ) {
        toastr.error("No categories found.");
        return;
      }
      let categoryData = `<option value="">--SELECT--</option>`;
      response.categories.forEach((res) => {
        categoryData += `<option value="${res.foodCategoryID}">${res.category}</option>`;
      });
      $("#categoryName").html(categoryData);
    },
  });

  $("#addFood").submit(function (e) {
    e.preventDefault();

    let foodName = $("#foodName").val().trim();
    let categoryID = $("#categoryName").val().trim();
    let foodImage = $("#foodImage")[0].files[0];
    let foodDescription = $("#foodDescription").val().trim();
    let foodPrice = $("#foodPrice").val().trim();
    let foodType = $("#foodType").val().trim();
    let foodStatus = $("#foodStatus").val().trim();

    let allowedExtension = ["jpg", "jpeg", "png"];
    let maxSize = 300 * 1024;
    let isValid = true;

    if (foodName === "") {
      toastr.error("foodName should not be blank");
      isValid = false;
    }
    if (categoryID === "") {
      toastr.error("category should not be blank");
      isValid = false;
    }
    if (!foodImage) {
      toastr.error("Pleaase Upload an Image");
      isValid = false;
    } else {
      let fileSize = foodImage.size;
      let fileExtension = foodImage.name.split(".").pop().toLowerCase();
      if (!allowedExtension.includes(fileExtension)) {
        toastr.error("Invalid File Type! Only jpg,jpeg,png  are allowed");
        isValid = false;
      }
      if (fileSize > maxSize) {
        toastr.error("File size exceeds 200KB limit");
        isValid = false;
      }
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
    if (foodType === "") {
      toastr.error("foodType should not be blank");
      isValid = false;
    }
    if (foodStatus === "") {
      toastr.error("foodStatus should not be blank");
      isValid = false;
    }
    if (isValid) {
      // toastr.success("Form validated successfully");
      let formData = new FormData();
      formData.append("foodName", foodName);
      formData.append("categoryID", categoryID);
      formData.append("foodImage", foodImage);
      formData.append("foodDescription", foodDescription);
      formData.append("foodPrice", foodPrice);
      formData.append("foodType", foodType);
      formData.append("foodStatus", foodStatus);
      formData.append("operation", "foodAdd");
      $.ajax({
        url: "../dbFunctions/foodAjax.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "present") {
            toastr.error("Food already exists!");
          } else if (response.status === "success") {
            toastr.success("Food Details added successfully");
            setTimeout(() => location.reload(), 500);
          } else if (response.status === "error") {
            toastr.error(response.message);
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
  document.getElementById("foodImage").addEventListener("change", function (e) {
    let file = document.getElementById("foodImage").files[0];
    let previewDiv = document.getElementById("img-preview-div");
    previewDiv.innerHTML = "";
    let reader = new FileReader();

    if (file) {
      reader.onload = function () {
        let img = document.createElement("img");
        img.src = reader.result;
        img.style.width = "100%";
        img.style.objectFit = "cover";
        previewDiv.appendChild(img);
      };
      reader.readAsDataURL(file);
    }
  });
});
