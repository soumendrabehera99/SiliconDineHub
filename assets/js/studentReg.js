$(document).ready(function () {
  let currentStep = 1;
  let totalSteps = $(".step").length;

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

  function validateSIC(sic) {
    if (!sic) return "SIC is Missing.";
    if (sic.length !== 8) return "SIC must be exactly 8 characters long";

    let sicPattern = /^[0-9]{2}[a-z]{4}[0-9]{2}$/i; // Example: 23mmci48
    if (!sicPattern.test(sic)) return "SIC format is invalid (e.g., 23mmci48)";

    return null; // No errors
  }

  $("#next-btn").click(function (e) {
    e.preventDefault();

    let sic = $("#sic").val();
    let sicError = validateSIC(sic);
    if (sicError) {
      toastr.error(sicError);
      return;
    }
    $.ajax({
      url: "./dbFunctions/authentication.php",
      method: "POST",
      data: {
        sic: sic.toUpperCase(),
        operation: "studentSignUp",
      },
      success: function (response) {
        // console.log(response);
        response = JSON.parse(response);
        let status = response.status;
        if (status == "present") {
          toastr.info("You are already Registered. Please log in to continue.");
        } else if (status == "success") {
          toastr.success(
            "SIC verified successfully! An OTP has been sent to your registered email."
          );
          $("#step-1").removeClass("active");
          $("#step-2").addClass("active");
          currentStep = 2;
          updateProgressBar();
          $("#otp").html(
            '<span style="color: green;">SIC verified successfully! An OTP has been sent to ' +
              userEmail +
              ".</span>"
          );
        } else if (status == "error1") {
          toastr.error(
            "The SIC you entered is not registered. Please contact the admin to register your SIC"
          );
        } else if (status == "error2") {
          toastr.error(
            "Connection failed! Please check your internet and retry."
          );
        } else {
          toastr.error("Unknown response: " + response, "Error");
        }
      },
      error: function () {
        toastr.error("An error occurred while submitting");
      },
    });
  });
  $("#prev-btn1").click(function (e) {
    e.preventDefault();
    $("#step-2").removeClass("active");
    $("#step-1").addClass("active");
    currentStep = 1;
    updateProgressBar();
  });

  function validateSIC(sic) {
    if (!sic) return "SIC is Missing.";
    if (sic.length !== 8) return "SIC must be exactly 8 characters long";

    let sicPattern = /^[0-9]{2}[a-z]{4}[0-9]{2}$/i; // Example: 23mmci48
    if (!sicPattern.test(sic)) return "SIC format is invalid (e.g., 23mmci48)";

    return null; // No errors
  }

  $("#verify-btn").click(function (e) {
    e.preventDefault();
    $("#step-2").removeClass("active");
    $("#step-3").addClass("active");
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
});
