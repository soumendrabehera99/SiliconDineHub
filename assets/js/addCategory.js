$(document).ready(function () {
  $("#addCategory").submit(function (e) {
    e.preventDefault();
    let categoryName = $("#categoryName").val();

    if (categoryName === "") {
      toastr.warning("Please enter a category name!", "Warning");
      return;
    }
    $.ajax({
      url: "../dbFunctions/addCategory.php",
      method: "POST",
      data: { category: categoryName },
      success: function (response) {
        if (response === "present") {
          toastr.error(response, "Category already exists!");
        } else if (response === "success") {
          toastr.success(response, "Category added successfully");
          $("#categoryName").val("");
        } else if (response === "error") {
          toastr.error(response, "There is an error in add category");
        }
      },
    });
  });
});
