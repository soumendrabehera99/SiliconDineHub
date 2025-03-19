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
        if (response) {
          $(".foodName").text(response.name);
          $(".foodPrice").text("₹" + response.price);
          $(".foodDetails").text(response.description);
        } else if (response) {
          toastr.error(response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
        toastr.error("An error occurred while fetching the food Details");
      },
    });
  }  else {
    toastr.error("No food ID found in URL.");
  }
});
