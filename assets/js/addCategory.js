$(document).ready(function () {
  $("#addCategory").submit(function (e) {
    e.preventDefault();
    let categoryName = $("#categoryName").val();
    console.log(categoryName);

    if (categoryName === "") {
      $("#msg").text("Please Enter a Category Name").trim();
      return;
    }
    $.ajax({
      url: "../dbFunctions/addCategory.php",
      method: "POST",
      data: { category: categoryName },
      success: function (response) {
        if (response === "present") {
          console.log(response, " already Present");
        } else if (response === "success") {
          console.log(response, "Category added successfully");
        } else if (response === "error") {
          console.log(response, "There is an error in add category");
        }
        $("#msg").text(response.message);
        $("#msg").removeClass("error success");
        $("#msg").addClass(response.status);
        if (response.status === "success") {
          $("#addCategoryModal").modal("hide");
          location.reload();
        }
      },
    });
  });
});
