<?php include_once "./fragment/navbar.php";?>
    <style>
        *{
            overflow: hidden;
        }
        .wrapper{
            width:70%;
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            object-position: center; 
        }
        .form-control:focus {
            box-shadow: none !important;
            border-color: goldenrod !important;
        }
        .form-control {
            border: 1px solid goldenrod;
            border-radius: 16px;
        }
        h1, h2{
            font-family: "Open Sans", sans-serif;
        }
    </style>
    <!-- sweetalert -->
    <link rel="stylesheet" href="./assets/sweetalert/sweetalert2.css" />
    
</head>
<body>

<div class="bg-dark">
    <div class="container d-flex align-items-center justify-content-center text-white" style="height: 90vh">
        <div class="row rounded g-0 wrapper">
            <div class="col-md-5 d-none d-md-block d-flex align-items-center justify-content-center">
                <img src="./assets/images/Cookie.webp" alt="A delicious cookie" class="img-fluid" style="width:100%">
                <!-- <img src="./assets/images/roti.jpg" alt="A delicious cookie" class="img-fluid" style="width:100%"> -->
            </div>
            <div class="col-md-7 bg-white d-flex align-items-center justify-content-center">
                <div class="text-dark">
                    <p class="mb-3 text-center fs-2 fw-bold mt-3 mt-md-0">Log In</p>
                    <form id="studentLoginForm" method="post" action="" class="px-1 px-md-0">
                        <div class="mt-3">
                            <label class="mb-3 form-label">Enter Your SIC</label>
                            <input type="text" class="form-control" id="sic">
                        </div>

                        <div class="mt-3">
                            <label class="mb-3 form-label">Enter Your Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="mt-3 text-center" >
                            <input type="submit" value="Log In" name="LogIn" class="btn btn-sm btn-warning py-2" style="border-radius: 16px; width:40%">
                        </div>
                    </form>
                    <div class="mt-2 text-center text-primary" style="font-size: 14px;">
                            <a href="forgotPasswordStudent.php" class="text-decoration-none">Forgot password</a>
                    </div>
                    <div class="">
                        <p class="text-center">If you're a new customer <a href="./studentSignUp.php" class="text-decoration-none">Sign-Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/7c45c78608.js" crossorigin="anonymous"></script>
<script src="./assets/jquery/jquery-3.7.1.min.js"></script>
<script src="./assets/sweetalert/sweetalert2.all.min.js"></script>
<script src="./assets/toastr/toastr.min.js"></script>
<script>
    // $(document).ready(function () {
    //     $("#togglePassword").click(function () {
    //         const passwordInput = $("#password");
    //         if (passwordInput.attr("type") === "password") {
    //             passwordInput.attr("type", "text");
    //             $(this).removeClass("fa-eye").addClass("fa-eye-slash");
    //         } else {
    //             passwordInput.attr("type", "password");
    //             $(this).removeClass("fa-eye-slash").addClass("fa-eye");
    //         }
    //     });

    //     toastr.options = {
    //         closeButton: true,
    //         progressBar: true,
    //         positionClass: "toast-bottom-right",
    //         timeOut: 3000
    //     };

    //     $("#studentLoginForm").submit(function (e) {
    //         e.preventDefault();

    //         let sic = $("#sic").val().trim();
    //         let password = $("#password").val().trim();
    //         let isValid = true;

    //         if (sic === "") {
    //             toastr.error("SIC cannot be empty.");
    //             isValid = false;
    //         } else if (sic.length !== 8) {
    //             toastr.error("SIC must be 8 characters.");
    //             isValid = false;
    //         } else if (sic.match(/^\d{2}[a-zA-Z]{4}\d{2}$/) === null) {
    //             toastr.error("Enter valid sic");
    //             isValid = false;
    //         }
    //         if (password === "" || password === " ") {
    //             toastr.error("Password cannot be empty.");
    //             isValid = false;
    //         }

    //         if (isValid) {
    //             $.ajax({
    //                 url: "./dbFunctions/studentLoginVerify.php",
    //                 type: "POST",
    //                 data: { sic: sic, password: password },
    //                 success: function (response) {
    //                     console.log("Server Response:", response);
    //                     if (response.trim() === "success") {
    //                         console.log("Student login successfully.");
    //                         window.location.href = "./index.php";
    //                     } else if (response.trim() === "Email not registered") {
    //                         toastr.error("Email not registered.");
    //                     } else if (response.trim() === "Password Incorrect") {
    //                         toastr.error("Incorrect password.");
    //                     } else {
    //                         toastr.error(response);
    //                     }
    //                 },
    //                 error: function (xhr, status, error) {
    //                     console.log("AJAX Error:", error);
    //                     toastr.error("An error occurred. Please try again.");
    //                 }
    //             });
    //         }
    //     });
    // });
    $(document).ready(function () {
    // Toggle Password Visibility
    $("#togglePassword").click(function () {
        const passwordInput = $("#password");
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordInput.attr("type", "password");
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#studentLoginForm").submit(function (e) {
        e.preventDefault();

        let sic = $("#sic").val().trim();
        let password = $("#password").val().trim();
        let isValid = true;

        if (sic === "") {
            Swal.fire("Error", "SIC cannot be empty.", "error");
            isValid = false;
        } else if (sic.length !== 8) {
            Swal.fire("Error", "SIC must be 8 characters.", "error");
            isValid = false;
        } else if (sic.match(/^\d{2}[a-zA-Z]{4}\d{2}$/) === null) {
            Swal.fire("Error", "Enter a valid SIC.", "error");
            isValid = false;
        }

        if (password === "" || password === " ") {
            Swal.fire("Error", "Password cannot be empty.", "error");
            isValid = false;
        }

        if (isValid) {
            $.ajax({
                url: "./dbFunctions/studentLoginVerify.php",
                type: "POST",
                data: { sic: sic, password: password },
                success: function (response) {
                    console.log("Server Response:", response);
                    if (response.trim() === "success") {
                        Swal.fire({
                            title: "<span style='font-family: Poppins, sans-serif;'>Login Successful!</span>",
                            text: "Redirecting to homepage...",
                            icon: "success",
                            timer: 3000,
                            showConfirmButton: false,
                            didClose: () => {
                                window.location.href = "./index.php"; // Redirect after alert closes
                            }
                        });

                    }else if (response.trim() === "Email not registered") {
                        Swal.fire("Error", "Email not registered.", "error");
                    }else if (response.trim() === "Password Incorrect") {
                        Swal.fire("Error", "Incorrect password.", "error");
                    }else if (response.trim() === "block") {
                        Swal.fire("Access Denied", "Your account has been blocked. Please contact support for Admin.", "error");
                    } else {
                        Swal.fire("Error", response, "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", error);
                    Swal.fire("Error", "An error occurred. Please try again.", "error");
                }
            });
        }
    });
});

</script>
</body>
</html>
