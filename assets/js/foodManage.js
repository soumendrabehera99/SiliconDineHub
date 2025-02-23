let foodCurrentPage = 1;
const foodsPerPage = 6;

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
                        <a class="position-absolute d-none btn-outline-warning btn btn-sm fm-uploadBtn">update</a>
                        <img src="http://localhost:8888/SiliconDineHub/uploads/${
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
                        }" food-id="${res.foodID}" food-status="${
          res.isAvailable
        }">${res.isAvailable == 1 ? "Available" : "Not Available"}
                          </button>
                    </td>
                    <td>
                        <a href="./editFood.php?foodID=${
                          res.foodID
                        }" class="btn btn-success btn-sm editFoodBtn">
                            <i class="fa-solid fa-edit"></i> Edit
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
  $("#allFoodBtn").click(function () {
    if ($("#searchFoodInput").val().trim() !== "") {
      location.reload();
    }
  });

  $("#deleteFood").submit(function (e) {
    e.preventDefault();
    let foodId = $("#deleteFoodId").val();
    let foodImageName = $("#foodImageName").val();
    // console.log(foodImageName);
    $.ajax({
      url: "../dbFunctions/foodAjax.php",
      method: "POST",
      data: {
        id: foodId,
        imageName: foodImageName,
        operation: "foodDelete",
      },
      success: function (response) {
        if (response === "success") {
          toastr.success(response, "Food deleted successfully");
          $("#deleteFood").trigger("reset");
          $("#deleteFoodModal").modal("hide");
          setTimeout(() => location.reload(), 500);
        } else if (response === "error") {
          toastr.error(response, "There is an error in delete food");
        } else if (response === "file_error") {
          toastr.error("file Doesnot exit");
        }
      },
    });
  });
  $(document).on("click", ".updateFoodStatusBtn", function () {
    let foodId = $(this).attr("food-id");
    let status = $(this).attr("food-status") == 1 ? 0 : 1;
    let searchTerm = $("#searchFoodInput").val().trim();
    console.log(foodId, status);
    $.ajax({
      url: "../dbFunctions/foodAjax.php",
      method: "POST",
      data: {
        id: foodId,
        status: status,
        operation: "foodStatusUpdate",
      },
      success: function (response) {
        if (response === "success") {
          toastr.success("Status Updated Successfully");
          // setTimeout(() => location.reload(), 500);
          fetchFoods(1, searchTerm);
        } else if (response === "error") {
          toastr.error("There is an error in Updated Status");
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
      let foodImage = btn.getAttribute("food-image");
      document.querySelector("#deleteFoodName").innerText = foodName;
      document.querySelector("#deleteFoodId").value = foodId;
      document.querySelector("#foodImageName").value = foodImage;
      console.log(foodImage);
    }
  });
});
