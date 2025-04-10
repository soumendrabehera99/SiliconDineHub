let cart = localStorage.getItem("cart");
// console.log(cart);
// localStorage.clear();
document.addEventListener("DOMContentLoaded", function () {
  showCart();

  document.getElementById("cart").addEventListener("click", function (event) {
    if (event.target.closest(".increaseBtn")) {
      let input = event.target
        .closest(".btnDiv")
        .querySelector(".quantityInput");
      const id = event.target.closest(".increaseBtn").getAttribute("data-id");
      // console.log(id);
      let quantity = parseInt(input.value);

      let cart1 = JSON.parse(cart);
      if (cart1[id]) {
        cart1[id].quantity += 1;
        input.value = quantity + 1;
      }
      localStorage.setItem("cart", JSON.stringify(cart1));
    }

    if (event.target.closest(".decreaseBtn")) {
      let input = event.target
        .closest(".btnDiv")
        .querySelector(".quantityInput");
      let quantity = parseInt(input.value);
      const id = event.target.closest(".decreaseBtn").getAttribute("data-id");
      // console.log(id);
      let cart1 = JSON.parse(cart);

      if (cart1[id] && quantity > 1) {
        cart1[id].quantity -= 1;
        if (quantity > 1) input.value = quantity - 1;
      }
      localStorage.setItem("cart", JSON.stringify(cart1));
    }
  });
});

function showCart() {
  //   console.log(cart);
  let price = 0;
  let quantity = 0;
  let cartItems = [];
  let completedRequests = 0;
  let cart1 = Object.entries(JSON.parse(cart));
  //   console.log(cart);

  cart1.forEach((element) => {
    $.ajax({
      url: "./dbFunctions/foodAjax.php",
      method: "POST",
      data: {
        foodID: element[0],
        operation: "getFoodDetails",
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        let cartItem = `
              <div class="row mt-2 p-3 border border-1 rounded-1 shadow-sm">
                  <div class="col-3 text-center p-2">
                      <img src="./uploads/${
                        response.image
                      }" class="img-fluid rounded-3" style="width:100px; height:100px">
                      <div class="mt-2 d-flex justify-content-center align-items-center btnDiv">
                          <button href="" class="btn bg-danger p-2 rounded-circle decreaseBtn" data-id="${
                            response.foodID
                          }">
                              <i class="fas fa-minus text-white"></i>
                          </button>
                          <input type="text" value="${
                            element[1].quantity
                          }" class="form-control text-center ms-2 quantityInput" style="width: 40px; display: inline-block;">
                          <button href="" class="btn bg-success p-2 rounded-circle ms-2 increaseBtn" data-id="${
                            response.foodID
                          }">
                              <i class="fas fa-plus text-white"></i>
                          </button>
                      </div>
                  </div>
                  <div class="col-4 p-3">
                      <h5 class="">${response.name}</h5>
                      <h5>Rs. ${response.price}</h5>
                  </div>
                  <div class="col-4 d-flex justify-content-center align-items-center">
                      Price = ${response.price * element[1].quantity}
                  </div>
                  <div class="col-1 d-flex justify-content-center align-items-center">
                      <button class="text-danger fs-5 border outline-none bg-transparent border-0"><i class="fa fa-trash"></i></button>
                  </div>
              </div>
          `;

        cartItems.push(cartItem);
        price += response.price * element[1].quantity;
        quantity += element[1].quantity;

        completedRequests++;

        if (completedRequests === cart1.length) {
          document.getElementById("cart").innerHTML = cartItems.join("");
          $("#totalItems").text(`Price (${quantity})`);
          $("#totalPrice").text(`Total: Rs. ${price}`);
          $("#taxTotalPrice").text(`Rs. ${price}`);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const modal = new bootstrap.Modal(document.getElementById("checkoutModal"));

  document
    .getElementById("checkoutBtn")
    .addEventListener("click", function (e) {
      e.preventDefault();
      showCheckout();
      modal.show();
    });
  document
    .getElementById("checkoutBtn")
    .addEventListener("click", function (e) {
      e.preventDefault();
      showCheckout();
      modal.show();
    });
});

function showCheckout() {
  // let cartData = JSON.parse(localStorage.getItem('cart'));
  // console.log(cart);
  let price = 0;
  let quantity = 0;
  let checkoutItems = [];
  let completedRequests = 0;
  let cart2 = Object.entries(JSON.parse(cart));

  // if (checkoutItems.length === 0) {
  //   document.getElementById("checkoutItems").innerHTML =
  //     `<tr><td colspan="3" class="text-center">Cart is empty</td></tr>`;
  //   document.getElementById("totalAmount").textContent = "₹0";
  //   return;
  // }

  cart2.forEach((element) => {
    $.ajax({
      url: "./dbFunctions/foodAjax.php",
      method: "POST",
      data: {
        foodID: element[0],
        operation: "getFoodDetails",
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        console.log(response.price);

        let ckItem = `
          <tr>
            <td>${response.name}</td>
            <td>${response.price}</td>
            <td>${element[1].quantity}</td>
            <td>₹${response.price * element[1].quantity}</td>
          </tr>
        `;
        checkoutItems.push(ckItem);
        price += response.price * element[1].quantity;
        quantity += element[1].quantity;
        completedRequests++;

        if (completedRequests === checkoutItems.length) {
          document.getElementById("checkoutItems").innerHTML =
            checkoutItems.join("");
          document.getElementById("totalAmount").textContent = `₹${price}`;
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        toastr.error("Failed to fetch food details");
      },
    });
  });
}
