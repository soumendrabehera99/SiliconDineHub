const foodID = new URLSearchParams(window.location.search).get("id");
console.log("Fetched food ID:", foodID);
$(document).ready(function () {
  if (foodID) {
    $.ajax({
      url: "./dbFunctions/foodAjax.php",
      method: "POST",
      data: {
        foodID: foodID,
        operation: "getFoodDetails",
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (response) {
          $("#foodImage").attr("src", "./uploads/" + response.image);
          $(".foodName").text(response.name);
          $(".foodPrice").text("₹" + response.price);
          $(".foodDetails").text(response.description);
          $("#addToCart").attr("data-id", foodID);
          $("#addToCart").attr("data-price", response.price);
        } else if (response) {
          toastr.error(response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  } else {
    toastr.error("No food ID found in URL.");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const addToCartBtn = document.querySelector("#addToCart");
  const quantityInput = document.querySelector("#quantityInput");
  const increaseBtn = document.querySelector("#increaseBtn");
  const decreaseBtn = document.querySelector("#decreaseBtn");

  increaseBtn.addEventListener("click", () => {
    let quantity = parseInt(quantityInput.value);
    quantityInput.value = quantity + 1;
  });

  decreaseBtn.addEventListener("click", () => {
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) quantityInput.value = quantity - 1;
  });

  addToCartBtn.addEventListener("click", () => {
    let quantity = parseInt(quantityInput.value);
    let productId = addToCartBtn.getAttribute("data-id");
    let price = addToCartBtn.getAttribute("data-price");

    addToCart(productId, quantity, price);
    alert("Product added to cart!");
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

  displayCart();
}

function displayCart() {
  console.log(localStorage.getItem("cart"));
}
