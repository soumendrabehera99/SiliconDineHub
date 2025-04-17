$(document).ready(function () {
  fetchActiveOrders();
  fetchPreviousOrders();

  setInterval(fetchActiveOrders, 300000);

  function fetchActiveOrders() {
    $.ajax({
      url: "./dbFunctions/orderAjax.php",
      type: "POST",
      data: { operation: "fetchActiveOrders" },
      dataType: "json",
      success: function (response) {
        if (response.error) {
          alert(response.error); // or toastr.warning
        }
        console.log(response);
        let activeHTML = "";
        response.forEach((order) => {
          activeHTML += `
                        <tr>
                            <td><img src="./uploads/${order.foodImage}" alt="${
            order.foodName
          }" width="60"></td>
                            <td>${order.foodName}</td>
                            <td>${order.createdAt}</td>
                            <td><span class="btn btn-sm btn-${
                              order.status === "pending" ? "primary" : "warning"
                            }">${order.status.toUpperCase()}</span></td>
                            <td class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i> ${
                              order.price
                            }</td>
                        </tr>`;
        });
        $("#activeOrders tbody").html(activeHTML);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  }

  function fetchPreviousOrders() {
    $.ajax({
      url: "./dbFunctions/orderAjax.php",
      type: "POST",
      data: { operation: "fetchPreviousOrders" },
      dataType: "json",
      success: function (response) {
        console.log(response);
        let previousHTML = "";
        response.forEach((order) => {
          previousHTML += `
                        <tr class="text-center">
                            <td><img src="./uploads/${order.foodImage}" alt="${order.foodName}" width="60"></td>
                            <td>${order.foodName}</td>
                            <td>${order.createdAt}</td>
                            <td><span class="btn btn-sm btn-success">${order.status}</span></td>
                            <td>${order.price}</td>
                        </tr>`;
        });
        console.log(previousHTML);
        $("#previousOrder tbody").html(previousHTML);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  }
});
