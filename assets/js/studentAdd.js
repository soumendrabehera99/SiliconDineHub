$(document).ready(function () {
  $("#addStudent").submit(function (e) {
    e.preventDefault();

    let sic = $("#sic").val();
    let email = $("#email").val();

    if (sic === "") {
      toastr.error("SIC should not be blank");
      return;
    }
    if (sic === "" || sic.length !== 8) {
      toastr.error("SIC must be exactly 8 characters long");
      return;
    }
    if (email === "") {
      toastr.error("email should not be blank");
      return;
    }
    if (!email.includes(sic)) {
      toastr.error("Enter registered email");
      return;
    }
    let emailPattern = /^[a-zA-Z0-9._%+-]+@silicon\.ac\.in$/;
    if (!emailPattern.test(email)) {
      toastr.error("Enter a valid email address");
      return;
    }

    $.ajax({
      url: "../dbFunctions/addStudent.php",
      method: "POST",
      data: { sic: sic, email: email },
      success: function (response) {
        // console.log(response); // Debugging line to check the actual response
        if (response.trim() === "present") {
          toastr.error("Student already exists!");
        } else if (response.trim() === "success") {
          toastr.success("Student added successfully");
          $("#addStudent").trigger("reset");
          setTimeout(() => location.reload(), 500);
        } else if (response.trim() === "error") {
          toastr.error("There was an error adding the student");
        } else {
          toastr.error("Unknown response: " + response, "Error");
        }
      },
      error: function () {
        toastr.error("An error occurred while submitting");
      },
    });    
  });
});
