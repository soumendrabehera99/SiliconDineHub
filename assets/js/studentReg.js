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
      toastr.error(sicError);
      $("#next-btn").attr("disabled", false);
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
          toastr.info("You are already Registered. Log in to continue...");
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
          toastr.error("SIC not registered. Contact admin.");
          $("#next-btn").attr("disabled", false);
        } else if (status == "error2") {
          toastr.error(
            "Connection failed! Please check your internet and retry."
          );
          $("#next-btn").attr("disabled", false);
        } else if (status == "error3") {
          toastr.error("Error in sending mail. Try again later.");
          $("#next-btn").attr("disabled", false);
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
      toastr.error(
        "Incorrect OTP !"
      );
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

    console.log(seID, sic, name, dob, password);

    // Validation: Check if any field is empty
    if (
      seID === "" ||
      sic === "" ||
      name === "" ||
      dob === "" ||
      password === ""
    ) {
      toastr.error("All fields are required !");
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
