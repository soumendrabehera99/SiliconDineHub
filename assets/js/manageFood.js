let foodCurrentPage = 1;
const foodsPerPage = 6;

function fetchFoods(page = 1, searchQuery = "") {
  $.ajax({
    url: "../dbFunctions/getFoods.php",
    method: "POST",
    data: { food: searchQuery, page: page, limit: foodsPerPage },
    dataType: "json",
    success: function (response) {
      if (response.error) {
        toastr.error(response.error);
        $("#categoryTableBody").html(
          `<tr><td colspan="3" class="text-center text-danger">${response.error}</td></tr>`
        );
        return;
      }

      if (!Array.isArray(response.foods) || response.foods.length === 0) {
        $("#categoryTableBody").html(
          `<tr><td colspan="3" class="text-center text-danger">No foods found</td></tr>`
        );
        return;
      }

      let tbody = "";
      let counter = (page - 1) * itemsPerPage + 1;
      response.foods.forEach((res) => {
        tbody += `<tr>
                    <td>${counter}</td>
                    <td>${res.name}</td>
                    <td>${
                      res.foodCategoryID == null
                        ? "Uncategorized"
                        : res.category
                    }</td>
                    <td>${res.price}</td>
                    <td>
                        <span 
                            class="d-inline-block rounded-circle me-2" 
                            style="height: 10px; width: 10px; background-color: ${
                              res.isAvailable == 1
                                ? "rgb(11, 218, 11)"
                                : "rgb(243, 64, 64)"
                            }">
                        </span>
                        ${res.isAvailable == 1 ? "Available" : "Not Available"}
                    </td>
                    <td>
                        <a href="foodDetails.php?id=<?php echo $food['foodID'] ?>" class="btn btn-success btn-sm">Available</a>
                        <a href="foodDelete.php?id=<?php echo $food['foodID'] ?>" class="btn btn-danger btn-sm" id="deleteStudent">Not Available</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm editFoodBtn" data-bs-toggle="modal" data-bs-target="#editFoodModal" food-id="${
                          res.foodID
                        }" food-name="${res.name}">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm deleteFoodBtn" data-bs-toggle="modal" data-bs-target="#deleteFoodModal" food-id="${
                          res.foodID
                        }" food-name="${res.name}">
                            <i class="fa-solid fa-trash"></i> Delete
                        </a>
                    </td>
                  </tr>`;
        counter++;
      });

      $("#foodTableBody").html(tbody);
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
      i === currentPage ? "active" : ""
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

  $("#foodPagination").html(paginationHTML);
}

$(document).ready(function () {
  fetchFoods();

  $(document).on("click", "#foodPagination .page-link", function (e) {
    e.preventDefault();
    const newPage = parseInt($(this).attr("data-page"));
    if (!isNaN(newPage)) {
      foodCurrentPage = newPage;
      fetchFoods(foodCurrentPage, $("#searchFoodInput").val());
    }
  });

  $("#foodSearchBtn").click(function () {
    fetchFoods(1, $("#searchFoodInput").val().trim());
  });
});

$(document).ready(function () {
  fetchFoods();

  $(document).on("click", "#pagination .page-link", function (e) {
    e.preventDefault();
    const newPage = parseInt($(this).attr("data-page"));
    if (!isNaN(newPage)) {
      foodCurrentPage = newPage;
      fetchFoods(foodCurrentPage, $("#searchFoodInput").val());
    }
  });

  $("#foodSearchBtn").click(function () {
    fetchFoods(1, $("#searchFoodInput").val().trim());
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
  $("#deleteFood").submit(function (e) {
    e.preventDefault();
    let foodId = $("#deleteFoodId").val();
    $.ajax({
      url: "../dbFunctions/deleteFood.php",
      method: "POST",
      data: {
        id: foodId,
      },
      success: function (response) {
        if (response === "success") {
          toastr.success(response, "Food deleted successfully");
          $("#deleteFood").trigger("reset");
          $("#deleteFoodModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.error(response, "There is an error in delete food");
        }
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (event) {
    if (event.target.closest(".deleteFoodBtn")) {
      let btn = event.target.closest(".deleteFoodBtn");
      let foodId = btn.getAttribute("food-id");
      let foodName = btn.getAttribute("food-name");
      document.querySelector("#deleteFoodName").innerText = foodName;
      document.querySelector("#deleteFoodId").value = foodId;
    }
  });
});
