$(document).ready(function(){
    $("#addFood").submit(function (e) {
        e.preventDefault();

        let foodName = $("#foodName").val();
        let categoryName = $("#categoryName").val();
        let foodImage = $("#foodImage").val();
        let foodDescription = $("#foodDescription").val();
        let foodPrice = $("#foodPrice").val();

        if (foodName === "") {
            toastr.error("foodName should not be blank");
            return;
        }
        if (categoryName === "") {
            toastr.error("categoryName should not be blank");
            return;
        }
        if(foodDescription === ""){
            toastr.error("foodDescription should not be blank");
            return;
        }
        if(foodPrice === ""){
            toastr.error("foodPrice should not be blank");
            return;
        }
    })
})