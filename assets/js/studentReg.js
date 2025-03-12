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

  $(document).ready(function () {
    $("#next-btn").click(function (event) {
      event.preventDefault(); // Prevent form submission

      $("#sic-section").hide(); // Hide SIC section
      $("#otp-section").show(); // Show OTP section
    });
  });

  $("#verify-btn").click(function (event) {
    event.preventDefault();
    $("#step-1").removeClass("active");
    $("#step-2").addClass("active");
    currentStep = 2;
    updateProgressBar();
  });

  $("#next-step-2").click(function () {
    $("#step-2").removeClass("active");
    $("#step-3").addClass("active");
    currentStep = 3;
    updateProgressBar();
  });

  updateProgressBar();
});
