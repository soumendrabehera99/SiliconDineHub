<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forgot Password</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- fevicon -->
    <link rel="icon" href="../assets/images/fevicon_logo.png" type="image/x-icon">
    <style>
        body {
            background-image: url('../assets/images/spaceBetween.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: -20px;
        }
        .form-control {
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
        }
        .form-control:focus {
            border-color: #f8d210 !important;
        }

        .btn-warning {
            transition: 0.3s ease-in-out;
        }
        .logo{
            margin-top: -30px;
        }
        @media (max-width: 576px) {
            img {
                width: 250px; /* Adjust size for mobile devices */
            }
        }
    </style>
</head>
<body class="bg-dark d-flex justify-content-center align-items-center vh-100 text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center mb-5 logo">
                <img src="../assets/images/logo.png" alt="logo" class="img-fluid">
            </div>
            <div class="col-12 col-md-5">
                <div class="glassmorphism p-4 rounded-2 mx-3 mx-md-0">
                    <h3 class="mb-3 text-center">Forgot Password</h3>
                    <form id="adminMailValidateForm" action="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" class="form-control shadow-none text-white bg-transparent boder-warning">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-warning mt-2" style="width: 32% !important;" media="(min-width: 768px)">Send OTP</button>
                        </div>
                    </form>
                    <form action="" id="forgotPasswordAdmin" method="POST">
                        <div class="mb-2">
                            <label class="form-label">OTP</label>
                            <input type="text" id="otp" class="form-control shadow-none text-white bg-transparent boder-warning">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">New Password</label>
                                    <input type="password" id="password" class="form-control shadow-none text-white bg-transparent boder-warning">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="text" id="cpassword" class="form-control shadow-none text-white bg-transparent boder-warning">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning w-100 mt-2" value="Reset Password">
                    </form>

                    <div class="mt-3 text-center">
                        <a href="./adminLogin.php" class="text-decoration-none text-white">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="../assets/jquery/jquery-3.7.1.min.js"></script>
<script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/toastr/toastr.min.js"></script>
<script src="../assets/sweetalert/sweetalert2.all.min.js"></script>

<!-- <script src="./assets/js/forgotPasswordAdmin.js"></script> -->
<script>
    $(document).ready(function () {   
        // Veryfy email  
        $("#adminMailValidateForm").submit(function (event) {
            event.preventDefault(); 

            let email = $("#email").val().trim();  
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (email === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Missing Email",
                    text: "Please enter your email.",
                });
                return;
            } else if (!email.match(emailRegex)) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Email",
                    text: "Please enter a valid email address (e.g., example@mail.com).",
                });
                return;
            }

            Swal.fire({
                title: "Sending OTP...",
                text: "Please wait while we send the OTP.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "../dbFunctions/forgotEmailVerifyAdmin.php",
                type: "POST",
                data: { email: email },
                dataType: "json",
                success: function (response) {
                    let status = response.status;

                    if (status === "Not found") {
                        Swal.fire({
                            icon: "error",
                            title: "Email Not Found",
                            text: "No account is associated with this email.",
                        });
                    } else if (status === "present") {
                        // for debug
                        console.log("OTP:", response.otp);

                        Swal.fire({
                            icon: "success",
                            title: "OTP Sent",
                            text: "Check your email for the OTP.",
                        });

                        $("#email").prop("readonly", true);
                        $("#adminMailValidateForm button").prop("disabled", true);
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Request Failed",
                        text: "There was an error sending the OTP. Please try again.",
                    });
                }
            });
        });

        // Change Password
        $("#forgotPasswordAdmin").submit(function (event) {
            event.preventDefault(); 
            
            let otp = $("#otp").val().trim();  
            let newPassword = $("#password").val().trim();  
            let cpassword = $("#cpassword").val().trim();  

            if (otp === "" || newPassword === "" || cpassword === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Missing fields",
                    text: "All fields are required.",
                });
                return;
            } else if (newPassword !== cpassword) {
                Swal.fire({
                    icon: "error",
                    title: "Password mismatch",
                    text: "New password and confirm password must be same",
                });
                return;
            }

            $.ajax({
                url: "../dbFunctions/forgotPasswordAdmin.php",
                type: "POST",
                data: { otp: otp, newPassword: newPassword }, 
                dataType: "json",
                success: function (response) {
                    let status = response.status;

                    if (status === "success") {
                        Swal.fire({
                            icon: "warning",
                            title: "Confirm Password Update",
                            text: "Are you sure you want to change your password?",
                            showCancelButton: true,
                            confirmButtonText: "Yes, update it!",
                            cancelButtonText: "Cancel"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Password Updated",
                                    text: "Your password has been successfully changed.",
                                }).then(() => {
                                    window.location.href = "adminLogin.php"; 
                                });
                            }
                        });
                    } else if (status === "Not found") {
                        Swal.fire({
                            icon: "error",
                            title: "Email Not Found",
                            text: "No account is associated with this email.",
                        });
                    } else if (status === "Otp mismatch") {
                        Swal.fire({
                            icon: "warning",
                            title: "Incorrect OTP",
                            text: "The OTP you entered is incorrect.",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Update Failed",
                            text: response.message || "An error occurred while updating the password.",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Request Failed",
                        text: "There was an error processing your request. Please try again.",
                    });
                }
            });
        });
    });
</script>