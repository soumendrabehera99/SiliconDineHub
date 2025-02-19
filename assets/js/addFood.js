$(document).ready(function(){
    $("#addFood").submit(function (e) {
        e.preventDefault();

        let foodName = $("#foodName").val().trim();
        let categoryName = $("#categoryName").val().trim();
        let foodImage = $("#foodImage")[0].files[0];
        let foodDescription = $("#foodDescription").val().trim();
        let foodPrice = $("#foodPrice").val().trim();
        let foodStatus = $("#foodStatus").val().trim();

        let allowedExtension = ["jpg", "jpeg", "png", "gif"];
        let maxSize = 60 * 1024;
        let isValid = true;

        if (foodName === "") {
            toastr.error("foodName should not be blank");
            isValid = false;
        }
        if (categoryName === "") {
            toastr.error("categoryName should not be blank");
            isValid = false;
        }
        if(!foodImage){
            toastr.error("Pleaase Upload an Image");
            isValid = false;
        } else{
            let fileSize = foodImage.size;
            let fileExtension = foodImage.name.split(".").pop().toLowerCase();
            if(!allowedExtension.includes(fileExtension)){
                toastr.error("Invalid File Type! Only jpg,jpeg,png & gif are allowed");
                isValid = false;
            }
            if(fileSize > maxSize){
                toastr.error("File size exceeds 60KB limit");
                isValid = false;
            }
        }
        if(foodDescription === ""){
            toastr.error("foodDescription should not be blank");
            isValid = false;
        }
        if(foodPrice === ""){
            toastr.error("foodPrice should not be blank");
            isValid = false;
        } else if(isNaN(foodPrice) || foodPrice <= 0){
            toastr.error("foodPrice should be a valid +ve number");
            isValid = false;
        }
        if(foodStatus === ""){
            toastr.error("foodStatus should not be blank");
            isValid = false;
        }
        if(isValid){
            toastr.success("Form validated successfully");
        }
    })
})