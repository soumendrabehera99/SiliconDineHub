document.addEventListener("DOMContentLoaded", function () {
  showCart();
});

function showCart() {
  let cart = localStorage.getItem("cart");
  //   localStorage.clear();
  console.log(cart);
  let price = 0;
  let quantity = 0;
  let cartItems = [];
  cart = Object.entries(JSON.parse(cart));
  console.log(cart);
  cart.forEach((element, index) => {
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
                    }" class="img-fluid rounded-3" style="width:100px;">
                    <div class="mt-2 d-flex justify-content-center align-items-center">
                        <a href="" class="btn bg-danger p-2 rounded-circle">
                            <i class="fas fa-minus text-white"></i>
                        </a>
                        <input type="text" value="${
                          element[1].quantity
                        }" class="form-control text-center ms-2" style="width: 40px; display: inline-block;">
                        <a href="" class="btn bg-success p-2 rounded-circle ms-2">
                            <i class="fas fa-plus text-white"></i>
                        </a>
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
        if (index === cart.length - 1) {
          document.getElementById("cart").innerHTML = cartItems.join("");
          $("#totalItems").text(`Price (${quantity})`);
          $("#totalPrice").text(`Total: Rs. ${price}`);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
    $("#totalItems").text(`Price (${quantity})`);
  });
}
