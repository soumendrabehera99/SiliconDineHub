// Set the Date input field 15 years back from the Current date
const dateInput = document.getElementById("facDOB");
const today = new Date();
const fifteenYearsAgo = new Date();
fifteenYearsAgo.setFullYear(today.getFullYear() - 15);
const formattedDate = fifteenYearsAgo.toISOString().split("T")[0];
dateInput.max = formattedDate;

$(document).ready(function () {
  let currentStep = 1;
  let totalSteps = $(".step").length;
  let otp = 0;
  let seID = 0;
  let facID = "";

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

  $("#fac-next-btn").click(function (e) {
    e.preventDefault();
    $("#fac-next-btn").attr("disabled", true);

    facSic = $("#facSIC").val();
    let sicError = validateFacultyID(facSic);

    if (sicError) {
      Swal.fire({
        icon: "error",
        title: "Invalid Faculty ID",
        text: idError,
      });
      $("#fac-next-btn").attr("disabled", false);
      return;
    }

    Swal.fire({
      title: "Processing...",
      text: "Verifying your Faculty ID and sending OTP...",
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading(),
    });

    $.ajax({
      url: "./../dbFunctions/authentication.php",
      method: "POST",
      data: {
        facSic: facSic.toUpperCase(),
        operation: "facultySignUp",
      },
      success: function (response) {
        response = JSON.parse(response);
        Swal.close();

        if (response.status === "present") {
          Swal.fire({
            icon: "info",
            title: "Already Registered",
            text: "Please log in instead.",
          });
          $("#fac-next-btn").attr("disabled", false);
        } else if (response.status === "success") {
          toastr.success("Faculty ID verified successfully!");
          $("#step-1").removeClass("active");
          $("#step-2").addClass("active");
          currentStep = 2;
          otp = response.otp;
          seID = response.seID;
          updateProgressBar();
          $("#otp").html(
            '<span style="color: green;">OTP has been sent to ' + response.email + ".</span>"
          );
        } else if (response.status === "error1") {
          Swal.fire({
            icon: "error",
            title: "ID Not Found",
            text: "Please contact admin.",
          });
        } else if (response.status === "error2" || response.status === "error3") {
          Swal.fire({
            icon: "error",
            title: "Error Occurred",
            text: "Try again later.",
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Unknown Error",
            text: "Response: " + response,
          });
        }
        $("#fac-next-btn").attr("disabled", false);
      },
      error: function () {
        Swal.close();
        Swal.fire({
          icon: "error",
          title: "Submission Error",
          text: "An error occurred. Try again.",
        });
        $("#fac-next-btn").attr("disabled", false);
      },
    });
  });

  $("#fac-prev-btn1").click(function (e) {
    e.preventDefault();
    $("#step-2").removeClass("active");
    $("#step-1").addClass("active");
    $("#fac-next-btn").attr("disabled", false);
    currentStep = 1;
    updateProgressBar();
  });

  $("#fac-verify-btn").click(function (e) {
    e.preventDefault();
    if ($("#fac-otp-input").val() != otp) {
      Swal.fire({
        icon: "error",
        title: "Incorrect OTP",
        text: "Please try again.",
      });
      return;
    }
    toastr.success("OTP Verified!");
    $("#step-2").removeClass("active");
    $("#step-3").addClass("active");
    $("#facSicInput").val(facID.toUpperCase());
    $("#facSeID").val(seID);
    currentStep = 3;
    updateProgressBar();
  });

  $("#fac-prev-btn2").click(function (e) {
    e.preventDefault();
    $("#step-3").removeClass("active");
    $("#step-2").addClass("active");
    currentStep = 2;
    updateProgressBar();
  });

  $("#facultyVerification").submit(function (e) {
    e.preventDefault();

    let seID = $("#facSeID").val().trim();
    let facSic = $("#facSicInput").val().trim();
    let name = $("#facName").val().trim();
    let dob = $("#facDOB").val();
    let password = $("#facPassword").val().trim();
    let cpassword = $("#fac-CPassword").val().trim();

    if (!seID || !facSic || !name || !dob || !password || !cpassword) {
      Swal.fire({
        icon: "error",
        title: "Missing Fields",
        text: "Please fill in all details.",
      });
      return;
    }

    if (!name.match(/^[A-Za-z\s]{2,}$/)) {
      Swal.fire({
        icon: "error",
        title: "Invalid Name",
        text: "Only letters and spaces, at least 2 characters.",
      });
      return;
    }

    if (
      password.length < 8 ||
      !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/.test(password)
    ) {
      Swal.fire({
        icon: "error",
        title: "Weak Password",
        text: "Must include uppercase, lowercase, digit & special character.",
      });
      return;
    }

    if (password !== cpassword) {
      Swal.fire({
        icon: "error",
        title: "Password Mismatch",
        text: "Passwords do not match.",
      });
      return;
    }

    let formData = {
      seID: seID,
      facSic: facSic,
      name: name,
      dob: dob,
      password: password,
      operation: "saveFaculty",
    };

    $.ajax({
      url: "./../dbFunctions/authentication.php",
      type: "POST",
      data: formData,
      success: function (response) {
        try {
          response = JSON.parse(response);
        } catch (e) {
          toastr.error("Invalid server response.");
          return;
        }

        if (response.status == "success") {
          Swal.fire({
            title: "Success!",
            text: "Faculty registration successful!",
            icon: "success",
            timer: 3000,
            showConfirmButton: false,
          });
          $("#facultyVerification")[0].reset();

          setTimeout(function () {
            window.location.href = "./../faculty/facultySignIn.php";
          }, 3000);
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message,
            icon: "error",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          title: "Server Error!",
          text: jqXHR.responseText,
          icon: "error",
        });
      },
    });
  });

  function validateFacultyID(facSic) {
    if (!facSic) return "SIC is Missing.";
    if (facSic.length !== 8) return "SIC must be exactly 8 characters long";

    let sicPattern = /^([0-9]{2}[a-zA-Z]{4}[0-9]{2}|FCS[0-9]{5})$/i;
  if (!sicPattern.test(facSic)) return "SIC format is invalid (e.g., 23mmci48 or FCS22210)";

    return null; 
  }

  updateProgressBar();
});
