$(document).ready(function(){

    $.ajax({
        url: "../dbFunctions/getAllCategory.php",
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
            if (response.error) {
                toastr.error(response.error);
                return;
            }
            if (!Array.isArray(response.categories) || response.categories.length === 0) {
                toastr.error("No categories found.");
                return;
            }
            let categoryData = `<option value="">--SELECT--</option>`;
            response.categories.forEach((res) => {
                categoryData += `<option value="${res.foodCategoryID}">${res.category}</option>`;
            })
            $("#categoryName").html(categoryData);
        }
    })

    $("#addFood").submit(function (e) {
        e.preventDefault();

        let foodName = $("#foodName").val().trim();
        let categoryName = $("#categoryName").val().trim();
        let foodImage = $("#foodImage")[0].files[0];
        let foodDescription = $("#foodDescription").val().trim();
        let foodPrice = $("#foodPrice").val().trim();
        let foodStatus = $("#foodStatus").val().trim();

        let allowedExtension = ["jpg", "jpeg", "png"];
        let maxSize = 300 * 1024;
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
                toastr.error("Invalid File Type! Only jpg,jpeg,png  are allowed");
                isValid = false;
            }
            if(fileSize > maxSize){
                toastr.error("File size exceeds 200KB limit");
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
            // toastr.success("Form validated successfully");
            let formData = new FormData();
            formData.append("foodName", foodName);
            formData.append("categoryName", categoryName);
            formData.append("foodImage", foodImage);
            formData.append("foodDescription", foodDescription);
            formData.append("foodPrice", foodPrice);
            formData.append("foodStatus", foodStatus);
            $.ajax({
                url: "../dbFunctions/addFood.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response === "present") {
                        toastr.error(response, "Food already exists!");
                    } else if (response === "success") {
                        toastr.success(response, "Food Details added successfully");
                        $("#addFood").submit();
                        $("#addFood").trigger("reset");
                        setTimeout(() => location.reload(), 500);
                    } else if (response === "error") {
                        toastr.error(response, "There is an error in add category");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", status, error);
                    console.log("Response text:", xhr.responseText);
                    toastr.error("Error submitting form: " + error);
                }
            })
        }
    })
})