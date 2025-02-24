let currentPage = 1;
const itemsPerPage = 6;

function fetchCategories(page = 1, searchQuery = "") {
  $.ajax({
    url: "../dbFunctions/categoryAjax.php",
    method: "POST",
    data: {
      category: searchQuery,
      page: page,
      limit: itemsPerPage,
      operation: "categoryGet",
    },
    dataType: "json",
    success: function (response) {
      if (response.error) {
        toastr.error(response.error);
        $("#categoryTableBody").html(
          `<tr><td colspan="3" class="text-center text-danger">${response.error}</td></tr>`
        );
        $("#pagination").html("");
        return;
      }

      if (
        !Array.isArray(response.categories) ||
        response.categories.length === 0
      ) {
        $("#categoryTableBody").html(
          `<tr><td colspan="3" class="text-center text-danger fw-bold">No categories found</td></tr>`
        );
        $("#pagination").html("");
        return;
      }

      let tbody = "";
      let counter = (page - 1) * itemsPerPage + 1;
      response.categories.forEach((res) => {
        tbody += `<tr>
                    <td>${counter}</td>
                    <td>${res.category}</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm editCategoryBtn" data-bs-toggle="modal" data-bs-target="#editCategoryModal" category-id="${res.foodCategoryID}" category-name="${res.category}">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm deleteCategoryBtn" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" category-id="${res.foodCategoryID}" category-name="${res.category}">
                            <i class="fa-solid fa-trash"></i> Delete
                        </a>
                    </td>
                  </tr>`;
        counter++;
      });

      $("#categoryTableBody").html(tbody);
      updatePagination(response.totalPages, response.currentPage);
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", xhr.responseText);
      toastr.error("An error occurred while fetching categories.");
    },
  });
}

function updatePagination(totalPages, currentPage) {
  let paginationHTML = "";

  paginationHTML += ` <li class="page-item ${
    currentPage == 1 ? "disabled" : ""
  }">
      <a class="page-link" href="#" aria-label="Previous" data-page="${
        currentPage - 1
      }">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>`;
  for (let i = 1; i <= totalPages; i++) {
    paginationHTML += `<li class="page-item ${
      i === currentPage ? "active z-0" : ""
    }">
        <a class="page-link" href="#" data-page="${i}">${i}</a>
      </li>`;
  }
  paginationHTML += ` <li class="page-item ${
    currentPage == totalPages ? "disabled" : ""
  }">
      <a class="page-link" href="#" aria-label="Previous" data-page="${
        currentPage + 1
      }">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>`;

  $("#pagination").html(paginationHTML);
}

$(document).ready(function () {
  fetchCategories();

  $(document).on("click", "#pagination .page-link", function (e) {
    e.preventDefault();
    const newPage = parseInt($(this).attr("data-page"));
    if (!isNaN(newPage) && newPage !== currentPage) {
      currentPage = newPage;
      fetchCategories(currentPage, $("#searchCategoryInput").val());
    }
  });

  $("#categorySearchBtn").click(function () {
    fetchCategories(1, $("#searchCategoryInput").val().trim());
  });

  $("#allCategoryBtn").click(function () {
    location.reload();
  });
  $("#addCategory").submit(function (e) {
    e.preventDefault();
    let categoryName = $("#categoryName").val();

    if (categoryName === "") {
      toastr.warning("Please enter a category name!", "Warning");
      return;
    }
    $.ajax({
      url: "../dbFunctions/categoryAjax.php",
      method: "POST",
      data: { category: categoryName, operation: "categoryAdd" },
      success: function (response) {
        if (response.status === "present") {
          toastr.error("Category already exists!");
        } else if (response.status === "success") {
          toastr.success("Category added successfully");
          $("#addCategory").trigger("reset");
          $("#addCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
          $("#categoryName").val("");
        } else if (response.status === "error") {
          toastr.error("There is an error in add category");
        }
      },
    });
  });
  $("#editCategory").submit(function (e) {
    e.preventDefault();
    let categoryId = $("#editCategoryId").val();
    let categoryName = $("#editCategoryName").val();
    $.ajax({
      url: "../dbFunctions/categoryAjax.php",
      method: "POST",
      data: {
        id: categoryId,
        category: categoryName,
        operation: "categoryUpdate",
      },
      success: function (response) {
        if (response.status === "present") {
          toastr.error("Category already exists!");
        } else if (response.status === "success") {
          toastr.success("Category updated successfully");
          $("#editCategory").trigger("reset");
          $("#editCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response.status === "error") {
          toastr.error("There is an error in update category");
        }
      },
    });
  });
  $("#deleteCategory").submit(function (e) {
    e.preventDefault();
    let categoryId = $("#deleteCategoryId").val();
    $.ajax({
      url: "../dbFunctions/categoryAjax.php",
      method: "POST",
      data: {
        id: categoryId,
        operation: "categoryDelete",
      },
      success: function (response) {
        if (response.status === "success") {
          toastr.success("Category deleted successfully");
          $("#deleteCategory").trigger("reset");
          $("#deleteCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response.status === "error") {
          toastr.error("There is an error in delete category");
        }
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (event) {
    if (event.target.closest(".editCategoryBtn")) {
      let btn = event.target.closest(".editCategoryBtn");
      let categoryId = btn.getAttribute("category-id");
      let categoryName = btn.getAttribute("category-name");

      document.querySelector("#editCategoryName").value = categoryName;
      document.querySelector("#editCategoryId").value = categoryId;
    } else if (event.target.closest(".deleteCategoryBtn")) {
      let btn = event.target.closest(".deleteCategoryBtn");
      let categoryId = btn.getAttribute("category-id");
      let categoryName = btn.getAttribute("category-name");

      document.querySelector("#deleteCategoryName").innerText = categoryName;
      document.querySelector("#deleteCategoryId").value = categoryId;
    }
  });
});
