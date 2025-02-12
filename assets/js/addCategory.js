$(document).ready(function(){
    $("#addCategory").submit(function(e){
        e.preventDefault();
        let categoryName = $("#categoryName").val();
        console.log(categoryName);

        if(categoryName === ""){
            $("#msg").text("Please Enter a Category Name").trim();
            return;
        }
        $.ajax({
            url: "../dbFunctions/addCategory.php",
            method: "POST",
            data: {category:categoryName},
            success: function(response){
                response = JSON.parse(response);
                $("#msg").text(response.message); 
                $("#msg").removeClass("error success"); 
                $("#msg").addClass(response.status);
                if (response.status === "success") {
                    $("#addCategoryModal").modal("hide");
                    location.reload();
                } 
            }
        })
    })
})
