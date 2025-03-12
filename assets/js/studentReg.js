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

    $("#next-btn").click(function () {
        $("#sic-section").hide();
        $("#otp-section").show();
    });

    $("#verify-btn").click(function () {
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