let currentPage = 1;
const itemsPerPage = 6;
function fetchCategories(page = 1, searchQuery = "") {
  $.ajax({
    url: "./dbFunctions/categoryAjax.php",
    method: "POST",
    data: {
      operation: "categoryGetAll",
    },
    dataType: "json",
    success: function (response) {
      console.log(response);

      if (response.error) {
        toastr.error(response.error);
        $("#category-bar").html(
          `<li colspan="3" class="text-center text-danger">${response.error}</li>`
        );
        return;
      }

      if (
        !Array.isArray(response.categories) ||
        response.categories.length === 0
      ) {
        $("#category-bar").html(
          `<li colspan="3" class="text-center text-danger">${response.error}</li>`
        );
        return;
      }

      let category = "";
      response.categories.forEach((res) => {
        category += `<a data-id ="${res.foodCategoryID}">${res.category}</a>`;
      });
      $("#category-bar").html(category);
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

function fetchFoods(page = 1, searchQuery = "") {
  $.ajax({
    url: "../dbFunctions/foodAjax.php",
    method: "POST",
    data: {
      food: searchQuery,
      page: page,
      limit: foodsPerPage,
      operation: "foodGet",
    },
    dataType: "json",
    success: function (response) {
      if (response.error) {
        toastr.error(response.error);
        $("#foodTableBody").html(
          `<tr><td colspan="7" class="text-center text-danger">${response.error}</td></tr>`
        );
        $("#foodPagination").html("");
        return;
      }

      if (!Array.isArray(response.foods) || response.foods.length === 0) {
        $("#foodTableBody").html(
          `<tr><td colspan="7" class="text-center text-danger fw-bold">No foods found</td></tr>`
        );
        $("#foodPagination").html("");
        return;
      }

      let tbody = "";
      let counter = (page - 1) * foodsPerPage + 1;
      response.foods.forEach((res) => {
        tbody += `<tr>
                      <td>${counter}</td>
                      <td>
                        <div class="position-relative d-flex align-items-center justify-content-center fm-imageDiv">
                          <a class="position-absolute d-none btn-outline-warning btn btn-sm fm-uploadBtn"
                          data-bs-toggle="modal" data-bs-target="#updateFoodImageModal"
                          food-id="${res.foodID}"
                          food-image="${res.image}"
                          >
                          update
                          </a>
                          <img src="../uploads/${
                            res.image
                          }" alt="NA" class="fm-image">
                        </div>
                      </td>
                      <td>${res.name}</td>
                      <td>
                      ${
                        res.foodCategoryID == null
                          ? "Uncategorized"
                          : res.category
                      }
                      </td>
                      <td>${res.price}</td>
                      <td>
                          <button  class="btn btn-sm updateFoodStatusBtn ${
                            res.isAvailable == 1 ? "btn-success" : "btn-danger"
                          }" data-bs-toggle="modal" data-bs-target="#updateStatusFoodModal"
                          food-id="${res.foodID}" 
                          food-status="${res.isAvailable}" 
                          food-name="${res.name}"
                          >
                            ${
                              res.isAvailable == 1
                                ? "Available"
                                : "Not Available"
                            }
                          </button>
                      </td>
                      <td>
                          <a href="./editFood.php?foodID=${
                            res.foodID
                          }" class="btn btn-success btn-sm editFoodBtn">
                              <i class="fa-solid fa-edit"></i> View
                          </a>
                          <a class="btn btn-danger btn-sm deleteFoodBtn" data-bs-toggle="modal" data-bs-target="#deleteFoodModal" food-id="${
                            res.foodID
                          }" food-name="${res.name}" food-image="${res.image}">
                              <i class="fa-solid fa-trash"></i> Delete
                          </a>
                      </td>
                    </tr>`;
        counter++;
      });

      //   $("#foodTableBody").html(tbody);
      updatePagination(response.totalPages, response.currentPage);
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", xhr.responseText);
      toastr.error("An error occurred while fetching categories.");
    },
  });
}

fetchCategories();
