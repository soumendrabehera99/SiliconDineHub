$(document).ready(function () {
  let currentStep = 1;
  let totalSteps = $(".step").length;
  let otp = 0;
  let seID = 0;
  let sic = "";
  function updateProgressBar() {
    $(".step").each(function (index) {
      if (index + 1 <= currentStep) {
        $(this).addClass("active");
      } else {
        $(this).removeClass("active");
      }
    });

    let progressWidth = ((currentStep - 1) / (totalSteps - 1)) * 100;
    $(".progress-line").css("width", progressWidth + "%");
  }

  $("#next-btn").click(function (e) {
    e.preventDefault();
    $("#next-btn").attr("disabled", true);
    
    sic = $("#sic").val();
    let sicError = validateSIC(sic);
    
    if (sicError) {
      Swal.fire({
        icon: "error",
        title: "Not a Valid SIC",
        text: sicError,
      });
      $("#next-btn").attr("disabled", false);
      return;
    }
  
    // Show SweetAlert2 Loader
    Swal.fire({
      title: "Processing...",
      text: "Please wait while we verify your SIC and send OTP.",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });
  
    $.ajax({
      url: "./dbFunctions/authentication.php",
      method: "POST",
      data: {
        sic: sic.toUpperCase(),
        operation: "studentSignUp",
      },
      success: function (response) {
        response = JSON.parse(response);
        let status = response.status;
        
        Swal.close(); // Close the loader when request is done
        
        if (status == "present") {
          Swal.fire({
            icon: "info",
            title: "Already Registered",
            text: "Please Log in to continue...",
          });
          $("#next-btn").attr("disabled", false);
        } else if (status == "success") {
          toastr.success("SIC verified successfully!");
          $("#step-1").removeClass("active");
          $("#step-2").addClass("active");
          currentStep = 2;
          otp = response.otp;
          seID = response.seID;
          updateProgressBar();
          $("#otp").html(
            '<span style="color: green;">OTP has been sent to ' +
              response.email +
              ".</span>"
          );
          console.log(seID, otp);
        } else if (status == "error1") {
          Swal.fire({
            icon: "error",
            title: "SIC Not Registered",
            text: "Please contact the admin for Registration.",
          });
          $("#next-btn").attr("disabled", false);
        } else if (status == "error2") {
          Swal.fire({
            icon: "error",
            title: "Connection Failed",
            text: "Please check your internet connection and try again.",
          });
          $("#next-btn").attr("disabled", false);
        } else if (status == "error3") {
          Swal.fire({
            icon: "error",
            title: "Mail Sending Error",
            text: "There was an issue sending the OTP. Please try again later.",
          });
          $("#next-btn").attr("disabled", false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Unknown Error",
            text: "Response: " + response,
          });
        }
      },
      error: function () {
        Swal.close(); // Close loader on error
        Swal.fire({
          icon: "error",
          title: "Submission Error",
          text: "An error occurred while submitting. Please try again.",
        });
        $("#next-btn").attr("disabled", false);
      },
    });
  });
  
  
  $("#prev-btn1").click(function (e) {
    e.preventDefault();
    $("#step-2").removeClass("active");
    $("#step-1").addClass("active");
    $("#next-btn").attr("disabled", false);
    currentStep = 1;
    updateProgressBar();
  });

  function validateSIC(sic) {
    if (!sic) return "SIC is Missing.";
    if (sic.length !== 8) return "SIC must be exactly 8 characters long";

    let sicPattern = /^[0-9]{2}[a-z]{4}[0-9]{2}$/i; // Example: 23mmci48
    if (!sicPattern.test(sic)) return "SIC format is invalid (e.g., 23xxxx12)";

    return null; // No errors
  }

  $("#verify-btn").click(function (e) {
    e.preventDefault();
    if ($("#otpInput").val() != otp) {
      Swal.fire({
        icon: "error",
        title: "Incorrect OTP",
        text: "The OTP you entered is incorrect. Please try again.",
      });
      return;
    }
    toastr.success("OTP Verified!");
    $("#step-2").removeClass("active");
    $("#step-3").addClass("active");
    $("#sicInput").val(sic.toUpperCase());
    $("#seIDInput").val(seID);
    currentStep = 3;
    updateProgressBar();
  });  
  $("#prev-btn2").click(function (e) {
    e.preventDefault();
    $("#step-3").removeClass("active");
    $("#step-2").addClass("active");
    currentStep = 2;
    updateProgressBar();
  });

  updateProgressBar();
  $("#stuVerification").submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    let seID = $("#seIDInput").val().trim();
    let sic = $("#sicInput").val().trim();
    let name = $("#name").val().trim();
    let dob = $("#dob").val();
    let password = $("#password").val().trim();
    let cpassword = $("#cpassword").val().trim();

    console.log(seID, sic, name, dob, password);

    // Validation: Check if any field is empty
    if (!seID || !sic || !name || !dob || !password || !cpassword) {
      Swal.fire({
        icon: "error",
        title: "Missing Fields",
        text: "All fields are required. Please fill in all the details.",
      });
      return;
    }
  
    // Validate Name (Only letters and spaces, at least 2 characters)
    if (!name.match(/^[A-Za-z\s]{2,}$/)) {
      Swal.fire({
        icon: "error",
        title: "Invalid Name",
        text: "Name should only contain letters and spaces, with at least 2 characters.",
      });
      return;
    }
  
    // Validate Date of Birth (Must be a past date)
    let today = new Date();
    let birthDate = new Date(dob);
    if (birthDate >= today) {
      Swal.fire({
        icon: "error",
        title: "Invalid Date of Birth",
        text: "Date of birth must be a past date.",
      });
      return;
    }
  
    // Validate Password Length (At least 8 characters)
    if (password.length < 8) {
      Swal.fire({
        icon: "error",
        title: "Password Too Short",
        text: "Password must be at least 8 characters long.",
      });
      return;
    }

    // Validate Password (At least 1 uppercase, 1 lowercase, 1 special character, 1 digit)
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    if (!password.match(passwordRegex)) {
      Swal.fire({
        icon: "error",
        title: "Weak Password",
        text: "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character (@, $, !, %, *, ?, &).",
      });
      return;
    }
  
    // Confirm Password Match
    if (password !== cpassword) {
      Swal.fire({
        icon: "error",
        title: "Password Mismatch",
        text: "Passwords do not match. Please try again.",
      });
      return;
    }

    let formData = {
      seID: seID,
      sic: sic,
      name: name,
      dob: dob,
      password: password,
      operation: "saveStudent",
    };

    $.ajax({
      url: "./dbFunctions/authentication.php",
      type: "POST",
      data: formData,
      success: function (response) {
          console.log(response);
          try {
              response = JSON.parse(response);
          } catch (e) {
              console.error("Invalid JSON response:", response);
              toastr.error("Invalid server response. Check console.");
              return;
          }
  
          let status = response.status;
          if (status == "success") {
              Swal.fire({
                  title: "Success!",
                  text: "Registration successful!",
                  icon: "success",
                  timer: 3000,
                  showConfirmButton: false
              });
  
              $("#stuVerification")[0].reset(); // Reset form
  
              setTimeout(function () {
                  window.location.href = "./studentSignIn.php"; // Redirect to index.php
              }, 3000);
          } else {
              Swal.fire({
                  title: "Error!",
                  text: response.message,
                  icon: "error"
              });
          }
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.error("AJAX Error: ", textStatus, errorThrown, jqXHR.responseText);
          Swal.fire({
              title: "Server Error!",
              text: jqXHR.responseText,
              icon: "error"
          });
      },
  });
  });
});
