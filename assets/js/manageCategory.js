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
          $("#addCategory").trigger("reset");
          $("#addCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
          $("#categoryName").val("");
        } else if (response === "error") {
          toastr.error(response, "There is an error in add category");
        }
      },
    });
  });
  $("#editCategory").submit(function (e) {
    e.preventDefault();
    let categoryId = $("#editCategoryId").val();
    let categoryName = $("#editCategoryName").val();
    $.ajax({
      url: "../dbFunctions/updateCategory.php",
      method: "POST",
      data: {
        id: categoryId,
        category: categoryName,
      },
      success: function (response) {
        if (response === "present") {
          toastr.error(response, "Category already exists!");
        } else if (response === "success") {
          toastr.success(response, "Category updated successfully");
          $("#editCategory").trigger("reset");
          $("#editCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.error(response, "There is an error in update category");
        }
      },
    });
  });
  $("#deleteCategory").submit(function (e) {
    e.preventDefault();
    let categoryId = $("#deleteCategoryId").val();
    $.ajax({
      url: "../dbFunctions/deleteCategory.php",
      method: "POST",
      data: {
        id: categoryId,
      },
      success: function (response) {
        console.log(response);
        if (response === "success") {
          toastr.success(response, "Category deleted successfully");
          $("#deleteCategory").trigger("reset");
          $("#deleteCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.error(response, "There is an error in delete category");
        }
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".editCategoryBtn").forEach((btn) =>
    btn.addEventListener("click", function () {
      let categoryId = this.getAttribute("category-id");
      let categoryName = this.getAttribute("category-name");

      document.querySelector("#editCategoryName").value = categoryName;
      document.querySelector("#editCategoryId").value = categoryId;
    })
  );
  document.querySelectorAll(".deleteCategoryBtn").forEach((btn) =>
    btn.addEventListener("click", function () {
      let categoryId = this.getAttribute("category-id");
      let categoryName = this.getAttribute("category-name");

      document.querySelector("#deleteCategoryName").innerText = categoryName;
      document.querySelector("#deleteCategoryId").value = categoryId;
    })
  );
});
