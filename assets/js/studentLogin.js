$("#studentSignin").submit(function (e) {
    e.preventDefault();
    let email = $("#email").val();
    let password = $("#password").val();

    if (email === "") {
      toastr.warning("Please enter your email!", "Warning");
      return;
    }
    if (password === "") {
        toastr.warning("Please enter your password!", "Warning");
        return;
      }
    $.ajax({
      url: "../dbFunctions/authentication.php",
      method: "POST",
      data: { email: email, password: password, operation: "studentLogin" },
      success: function (response) {
        if (response.status === "present") {
          toastr.error("Category already exists!");
        } else if (response.status === "success") {
          toastr.success("Category added successfully");
          $("#addCategory").trigger("reset");
          $("#addCategoryModal").modal("hide");
          setTimeout(() => location.reload(), 500);
          $("#categoryName").val("");
        } else if (response.status === "error") {
          toastr.error("There is an error in add category");
        }
      },
    });
  });