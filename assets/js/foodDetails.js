const foodID = new URLSearchParams(window.location.search).get("id");
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
      error: function () {
        alert("Error fetching food details.");
      },
    });
  }
});
