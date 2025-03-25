let currentPage = 1;
const itemsPerPage = 50;
//get search parameter
const urlParams = new URLSearchParams(window.location.search);
let searchQuery = urlParams.get("search");

fetchCategories();
if (searchQuery) {
  const message = "No food items listed with your search.!";
  fetchFoods(1, searchQuery, null, message);
} else {
  fetchFoods();
}
//search query
function fetchCategories(page = 1, searchQuery = "") {
  $.ajax({
    url: "./dbFunctions/categoryAjax.php",
    method: "POST",
    data: {
      operation: "categoryGetAll",
    },
    dataType: "json",
    success: function (response) {
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
        category += `<a href="#" class="sidebar-link" data-id ="${res.foodCategoryID}" id="data-item-id">
                        <!-- <img src="./assets/images/f2.png" alt="Veg" class="img-fluid"> -->
                        <div class="fs-md-6">${res.category}</div>
                    </a>`;
        // <a href="#" class="sidebar-link" data-category="veg">
        //     <img src="./assets/images/f2.png" alt="Veg" class="img-fluid">
        //     <div style="font-size: 12px;">Veg</div>
        // </a>
      });
      $("#category-bar").html(category);
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", xhr.responseText);
      toastr.error("An error occurred while fetching categories.");
    },
  });
}

//pagination
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

//food fetch
function fetchFoods(page = 1, searchQuery = "", categoryID = null, message) {
  $.ajax({
    url: "./dbFunctions/foodAjax.php",
    method: "POST",
    data: {
      food: searchQuery,
      page: page,
      limit: itemsPerPage,
      categoryID: categoryID,
      operation: "foodGetPlp",
    },
    dataType: "json",
    success: function (response) {
      if (response.error) {
        toastr.error(response.error);
        $("#fooddisplaydiv").html(
          `<tr><td colspan="7" class="text-center text-danger">${response.error}</td></tr>`
        );
        $("#foodPagination").html("");
        return;
      }

      if (!Array.isArray(response.foods) || response.foods.length === 0) {
        $("#fooddisplaydiv").html(
          `<p class="text-center text-danger fw-bold">${message}</p>`
        );
        $("#foodPagination").html("");
        return;
      }

      let tbody = "";
      const cart = JSON.parse(localStorage.getItem("cart")) || {};
      response.foods.forEach((res) => {
        tbody += `
          <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                <div class="card border-1 shadow-sm">
                <a href="foodDetails.php?id=${
                  res.foodID
                }" class="text-decoration-none">
                    <div class="text-center mt-3">
                        <img src="./assets/images/f2.png" class="card-img-top img-fluid" alt="Ice-Cream" 
                            style="max-width: 100px; height: auto;">
                    </div>
                    </a>
                    <div class="card-body">
                    <a href="foodDetails.php?id=${
                      res.foodID
                    }" class="text-decoration-none">
                        <h6 class="card-title text-truncate-1 text-dark">${
                          res.name
                        }</h6>
                        <p class="small text-muted mb-1 text-truncate-3" style="font-size: 10px; text-align: justify;">
                            ${res.description}
                        </p>
                        <h4 class="mb-1 text-dark"><strong>&#8377;${
                          res.price
                        }</strong></h4>
                        </a>
                        ${
                          cart[res.foodID]
                            ? `<button class="btn btn-outline-warning w-100 goToCartBtn">Go to Cart</button>`
                            : `<button class="btn btn-outline-success w-100 addBtn" data-id="${res.foodID}" data-price="${res.price}">ADD</button>`
                        }
                      </div>
                </div>
          </div>
        `;
      });

      $("#fooddisplaydiv").html(tbody);
      updatePagination(response.totalPages, response.currentPage);
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", xhr.responseText);
      toastr.error("An error occurred while fetching categories.");
    },
  });
}

//side bar active link
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("category-bar")
    .addEventListener("click", function (event) {
      let target = event.target.closest(".sidebar-link");
      if (!target) return; // If clicked outside of a sidebar link, do nothing

      event.preventDefault();

      // Remove active class from all links
      document.querySelectorAll(".sidebar-link").forEach((link) => {
        link.classList.remove("active");
      });

      // Add active class to the clicked link
      setTimeout(() => {
        target.classList.add("active");
      }, 100);
    });
});
$(document).ready(function () {
  $(document).on("click", ".sidebar-link", function () {
    let id = $(this).data("id");
    const message =
      "No food items available in this category. Please check other categories!";
    fetchFoods(1, "", id, message);
    console.log(id);
  });

  $(document).on("click", ".addBtn", function () {
    console.log("Clicked Add Button");

    let productId = $(this).attr("data-id");
    let price = $(this).attr("data-price");

    // console.log("Product ID:", productId);
    // console.log("Price:", price);

    addToCart(productId, 1, price);
  });
});

function addToCart(id, quantity, price) {
  let cart = JSON.parse(localStorage.getItem("cart")) || {};

  if (cart[id]) {
    cart[id].quantity = quantity;
  } else {
    cart[id] = { price, quantity: quantity };
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  location.reload();
  displayCart();
}

function displayCart() {
  console.log(localStorage.getItem("cart"));
}
