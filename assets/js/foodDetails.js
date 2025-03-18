const foodID = new URLSearchParams(window.location.search).get("id");
$(document).ready(function () {
    if (foodID) {
        $.ajax({
            url: "./dbFunctions/foodAjax.php",
            method: "POST",
            data: {
                operation: "getFoodDetails",
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $(".foodName").text(response.name);
                    $(".foodPrice").text("₹" + data.price);
                    $(".foodDetails").text(data.description);
                } else if (response.error){
                    toastr.error(response.error);
                }
            },
            error: function () {
                alert("Error fetching food details.");
            }
        });
    }
});