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
            <div class="row g-0 border rounded shadow-sm small-card align-items-center">
              <div class="col-md-2 p-2 d-flex justify-content-center align-items-center">
                <img src="./uploads/${order.foodImage}" class="img-fluid rounded" alt="${order.foodName}">
              </div>
              <div class="col-md-10">
                <div class="card-body py-1">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h5 class="card-title fw-bold">${order.foodName}</h5>
                      <p class="card-text">Date: ${order.createdAt}</p>
                      <p class="card-text fw-bold">
                        <i class="fa-solid fa-indian-rupee-sign"></i> ${order.price}
                      </p>
                    </div>
                    <div class="text-center">
                      <p class="card-text">Counter:
                        <span class="badge bg-success">${order.counterName.toUpperCase() ?? 'N/A'}</span>
                      </p>
                    </div>
                    <div class="text-end">
                      <p class="card-text">
                      Status:
                        <span class="badge bg-${order.status === "pending" ? "primary" : "success"}">
                        ${order.status.toUpperCase()}
                        </span>
                      </p>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>`;
        });
        $("#activeOrders").html(activeHTML);

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
                      <div class="row g-0 border rounded shadow-sm small-card align-items-center">
                        <div class="col-md-2 p-2 d-flex justify-content-center align-items-center">
                          <img src="./uploads/${order.foodImage}" class="img-fluid rounded" alt="${order.foodName}">
                        </div>
                        <div class="col-md-10">
                          <div class="card-body py-1">
                            <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h5 class="card-title fw-bold">${order.foodName}</h5>
                                <p class="card-text">Date: ${order.createdAt}</p>
                                <p class="card-text fw-bold">
                                  <i class="fa-solid fa-indian-rupee-sign"></i> ${order.price}
                                </p>
                              </div>
                              <div class="text-center">
                                <p class="card-text">Counter:
                                  <span class="badge bg-success">${order.counterName}</span>
                                </p>
                              </div>
                              <div class="text-end">
                                <p class="card-text">
                                Status:
                                  <span class="badge bg-success">
                                  ${order.status.toUpperCase()}
                                  </span>
                                </p>
                              </div>
                            </div> 
                          </div>
                        </div>
                      </div>`;
        });
        console.log(previousHTML);
        $("#previousOrder").html(previousHTML);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  }
});

// custom js
const orderPeriod = document.getElementById('orderPeriod');
    const quickSearch = document.getElementById('quickSearch');
    const orderPeriodFields = document.getElementById('orderPeriodFields');
    const quickSearchFields = document.getElementById('quickSearchFields');
    const downloadBtn = document.getElementById('downloadBtn');
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');

    // Show relevant fields based on main selection
    orderPeriod.addEventListener('change', () => {
        if (orderPeriod.checked) {
            orderPeriodFields.style.display = 'block';
            quickSearchFields.style.display = 'none';
            downloadBtn.style.display = 'none';  // Hide until valid
        }
    });

    quickSearch.addEventListener('change', () => {
        if (quickSearch.checked) {
            orderPeriodFields.style.display = 'none';
            quickSearchFields.style.display = 'block';
            downloadBtn.style.display = 'none';  // Hide until valid
        }
    });

    // Validate Order Period date inputs
    function validateOrderPeriod() {
        if (fromDate.value && toDate.value) {
            downloadBtn.style.display = 'block';
        } else {
            downloadBtn.style.display = 'none';
        }
    }

    fromDate.addEventListener('input', validateOrderPeriod);
    toDate.addEventListener('input', validateOrderPeriod);

    // Validate Quick Search selection
    document.querySelectorAll('input[name="quickOption"]').forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.checked) {
                downloadBtn.style.display = 'block';
            }
        });
    });



    // excell sheet

  //   document.getElementById('downloadBtn').addEventListener('click', function() {
  //     const orderOption = document.querySelector('input[name="orderOption"]:checked');
  
  //     let formData = new FormData();
  
  //     if (orderOption && orderOption.value === 'period') {
  //         const fromDate = document.getElementById('fromDate').value;
  //         const toDate = document.getElementById('toDate').value;
  //         if (!fromDate || !toDate) {
  //             alert("Please select both From Date and To Date.");
  //             return;
  //         }
  //         formData.append('fromDate', fromDate);
  //         formData.append('toDate', toDate);
  
  //     } else if (orderOption && orderOption.value === 'quick') {
  //         const quickOption = document.querySelector('input[name="quickOption"]:checked');
  //         if (!quickOption) {
  //             alert("Please select a quick search option.");
  //             return;
  //         }
  //         formData.append('quickOption', quickOption.value);
  //     } else {
  //         alert("Please select Order Period or Quick Search.");
  //         return;
  //     }
  
  //     fetch('./dbFunctions/export_order.php', {
  //         method: 'POST',
  //         body: formData
  //     })
  //     .then(response => {
  //         if (!response.ok) throw new Error("Server error or file generation failed.");
  //         return response.blob();
  //     })
  //     .then(blob => {
  //         const url = window.URL.createObjectURL(blob);
  //         const a = document.createElement('a');
  //         const now = new Date();
  //         const timestamp = now.toISOString().slice(0,19).replace(/[:T]/g, '-');
  //         a.href = url;
  //         a.download = `Order_Statement_${timestamp}.xlsx`;
  //         document.body.appendChild(a);
  //         a.click();
  //         a.remove();
  //     })
  //     .catch(error => {
  //         alert(error.message);
  //     });
  // });
  
