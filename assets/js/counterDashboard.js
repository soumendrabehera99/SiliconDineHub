$(document).ready(function () {
  // Logout confirmation
  $("#logoutBtn").on("click", function (e) {
    e.preventDefault(); // prevent direct redirect

    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, logout",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "./counterLogout.php";
      }
    });
  });
});
// Incoming Orders Search
document
  .getElementById("searchIncoming")
  .addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll(".orders:nth-of-type(1) tbody tr");

    rows.forEach((row) => {
      let orderId = row.cells[0].textContent.toLowerCase(); // Only Order ID cell
      row.style.display = orderId.includes(value) ? "" : "none";
    });
  });

// Completed Orders Search
document
  .getElementById("searchCompleted")
  .addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll(".orders:nth-of-type(2) tbody tr");

    rows.forEach((row) => {
      let orderId = row.cells[0].textContent.toLowerCase();
      row.style.display = orderId.includes(value) ? "" : "none";
    });
  });

// fetch incoming and completed orders
// This function fetches data from the server and populates the tables
function fetchOrders() {
  $.ajax({
    url: "./dbFunctions/counterDashboardFetchOrders.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      let incomingHTML = "";
      let readyHTML = "";
      //   console.log(data);

      if (Array.isArray(data) && data.length > 0) {
        data.forEach(function (order) {
          let row = `
                          <tr>
                              <td>${order.orderID}</td>
                              <td>${order.name}</td>
                              <td>${order.foodName}</td>
                              <td style="color:${
                                order.orderType == "Delivery" ? "red" : ""
                              }">${
            order.orderType
          }</br><span style="color:black">${order.address}</span></td>
                              <td>
                                  <a href="./dbFunctions/orderStatusUpdate.php?id=${
                                    order.id
                                  }&status=${
            order.status === "pending" ? "ready" : "delivered"
          }">
                                      <button class="btn btn-sm ${
                                        order.status === "pending"
                                          ? "btn-warning"
                                          : "btn-success"
                                      }">
                                      ${
                                        order.status === "pending"
                                          ? "Ready"
                                          : "Delivered"
                                      }
                                      </button>
                                  </a>
                              </td>
      
                          </tr>
                      `;

          if (order.status === "pending") {
            incomingHTML += row; // pending orders go to Incoming Orders
          } else if (order.status === "ready") {
            readyHTML += row; // ready orders go to Pending Orders
          }
        });
      } else {
        incomingHTML = `<tr><td colspan="5" class="text-center">No Incoming Orders</td></tr>`;
        readyHTML = `<tr><td colspan="5" class="text-center">No Pending Orders</td></tr>`;
      }

      // Append data to respective tables
      $(".orders").eq(0).find("tbody").html(incomingHTML); // Incoming Orders (pending)
      $(".orders").eq(1).find("tbody").html(readyHTML); // Pending Orders (ready)
    },
    error: function (xhr, status, err) {
      console.error("Error:", err);
    },
  });
}
fetchOrders();
setInterval(fetchOrders, 10000);
