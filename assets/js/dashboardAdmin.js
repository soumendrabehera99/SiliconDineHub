var orderData;

// Show the spinner while loading
$("#loadingSpinner").show();

$(document).ready(function () {
  function fetchTopSelling(days) {
    $.ajax({
      url: "../dbFunctions/orderAjax.php",
      method: "POST",
      data: {
        operation: "fetchTopSellingFood",
        days: days,
      },
      dataType: "json",
      success: function (response) {
        // console.log(response);

        const list = $("#topSellingList");
        list.empty();

        if (!response || response.length === 0) {
          list.append('<li class="text-muted">No data found</li>');
          return;
        }

        response.forEach((item) => {
          const imgSrc = `../uploads/${item.image}`;
          const html = `
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="${imgSrc}" class="rounded-3 me-3 img-fluid" alt="${item.name}" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">${item.name}</div>
                                <div class="fw-bold">Rs. ${item.price}</div>
                            </div>
                        </div>
                        <div>Qty: ${item.totalSold}</div>
                    </li>`;
          list.append(html);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching top-selling food:", error);
        $("#topSellingList").html(
          '<li class="text-danger">Error loading data</li>'
        );
      },
    });
  }

  // Initial load
  fetchTopSelling(1);

  // Handle dropdown change
  $("#weekSelectorItems").change(function () {
    const selectedDays = $(this).val();
    fetchTopSelling(selectedDays);
  });
  $.ajax({
    url: "../dbFunctions/dashboardAjax.php",
    method: "GET",
    data: { operation: "fetchOrderData" }, // Send operation type
    dataType: "json",
    success: function (data) {
      if (data.error) {
        console.error(data.error);
        $("#loadingSpinner").html(
          '<p style="color:red;">' + data.error + "</p>"
        );
        return;
      }

      orderData = data;
      $("#loadingSpinner").hide(); // Hide spinner
      renderChart(6); // Initialize chart after data is loaded
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      $("#loadingSpinner").html(
        '<p style="color:red;">Failed to load data.</p>'
      );
    },
  });

  function fetchLoyalCustomers() {
    $.ajax({
      url: "../dbFunctions/orderAjax.php",
      method: "POST",
      data: {
        operation: "fetchLoyalCustomer",
      },
      dataType: "json",
      success: function (response) {
        const list = $("#loyalCustomerList");
        list.empty();

        if (!Array.isArray(response) || response.length === 0) {
          list.append('<li class="text-muted">No loyal customers found</li>');
          return;
        }

        response.forEach((c) => {
          const html = `
                <li class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="d-flex justify-content-between"> <span class="fw-semibold">${
                          c.name
                        }</span> <span>Rs. ${c.spent}</span></div>
                        <small class="text-muted">${
                          c.orders
                        } Orders | Member since ${c.joined}</small>
                    </div>
                    <span class="badge ${
                      c.badge === "VIP"
                        ? "bg-success"
                        : c.badge === "Gold"
                        ? "bg-warning text-dark"
                        : "bg-secondary"
                    }">${c.badge}</span>
                </li>`;
          list.append(html);
        });
      },
      error: function (err) {
        $("#loyalCustomerList").html(
          '<li class="text-danger">Failed to load customers</li>'
        );
        console.error("Error fetching customers:", err);
      },
    });
  }

  fetchLoyalCustomers();
});

function getFilteredData(days) {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - days);

  return orderData.filter((order) => {
    const orderDate = new Date(order.createdAt);
    return orderDate >= startDate && orderDate <= endDate;
  });
}

function renderChart(days) {
  const noDataDiv = document.getElementById("noDataMessage");

  if (!orderData) {
    console.error("Order data not loaded yet.");
    return;
  }

  const filteredData = getFilteredData(days);

  if (filteredData.length === 0) {
    if (window.myChart) {
      window.myChart.destroy();
    }
    noDataDiv.style.display = "block";
    return;
  } else {
    noDataDiv.style.display = "none";
  }

  const dates = filteredData.map((order) => {
    const orderDate = new Date(order.createdAt);
    return orderDate.toLocaleDateString();
  });

  const sales = filteredData.map((order) => parseFloat(order.price));

  const ctx = document.getElementById("salesChart").getContext("2d");

  if (window.myChart) {
    window.myChart.destroy();
  }

  window.myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: dates,
      datasets: [
        {
          label: "Sales",
          data: sales,
          borderColor: "rgba(75, 192, 192, 1)",
          fill: false,
        },
      ],
    },
    options: {
      scales: {
        x: {
          type: "category",
          title: {
            display: true,
            text: "Date",
          },
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: "Sales ($)",
          },
        },
      },
    },
  });
}

// Handle day selector change
$("#daySelector").on("change", function () {
  const selectedDays = parseInt($(this).val());
  renderChart(selectedDays);
});
