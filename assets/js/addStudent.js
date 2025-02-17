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
                if (response === "present") {
                    toastr.error(response, "Student already exists!");
                } else if (response === "success") {
                    toastr.success(response, "Student added successfully");
                    $("#addStudent").trigger("reset");
                    setTimeout(() => location.reload(), 500);
                } else if (response === "error") {
                    toastr.error(response, "There was an error adding the student");
                } else {
                    toastr.error("Unknown response", "Error");
                }
            },
            error: function () {
                toastr.error("An error occurred while submitting");
            }
        });
    });
});
