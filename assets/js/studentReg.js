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

        // Calculate progress bar width (green until the last completed step)
        let progressWidth = ((currentStep - 1) / (totalSteps - 1)) * 100;
        $(".progress-line").css("width", progressWidth + "%");

        // // Calculate correct progress line width (stops at the center of active step)
        // let stepWidth = $(".step").outerWidth();
        // let progressWidth = ((currentStep - 1) / 2) * 100 + (stepWidth / $(".progress-bar").width()) * 50;
        // $(".progress-line").css("width", progressWidth + "%");
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
