<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/toastr/toastr.min.css" rel="stylesheet">
    <!-- fevicon -->
    <link rel="icon" href="../assets/images/fevicon_logo.png" type="image/x-icon">
    <style>
        body {
            background-image: url('../assets/images/admin_Login_Image_01.jpeg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: 100vh;
            width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .password-wrapper i {
            right: 10px;
            top: 43%;
            cursor: pointer;
        }
        .form-control:focus {
            border-color: #f8d210 !important;
        }
        /* Shadow remove from toastr */
        .toast {
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
        }
        /* Hide default browser eye icon in password fields */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-password-toggle-button {
            display: none;
        }
    </style>
</head>

<body class="vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 ms-3 mt-5">
                <img src="../assets/images/logo.png">
            </div>
        </div>
        <div class="row w-100">
            <div class="card col-md-4 p-4 mt-5 shadow-lg glassmorphism rounded border-secondary">
                <h3 class="text-center mb-4 text-white">Admin Login</h3>
    
                <form action="" method="post" id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email ID</label>
                        <input type="email" class="form-control shadow-none bg-transparent text-white border-white"
                            id="email">
                    </div>
                    <div class="mb-3 password-wrapper position-relative">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" class="form-control shadow-none bg-transparent text-white border-white"
                            id="password">
                        <i class="fas fa-eye text-white position-absolute" id="togglePassword"></i>
                        <div class="text-end mt-2">
                            <a href="./forgotPassword.php" class="text-decoration-none text-white">Forgot Password</a>
                        </div>
                    </div>
                    <input type="submit" value="Login" class="btn btn-warning w-100">
                </form>
            </div>
    
        </div>
    </div>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7c45c78608.js" crossorigin="anonymous"></script>
    <script src="../assets/jquery/jquery-3.7.1.min.js"></script>
    <script src="../assets/toastr/toastr.min.js"></script>
    <script>
        $(document).ready(function () {

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

            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-bottom-left",
                timeOut: 3000
            };

            $("#loginForm").submit(function (e) {
                e.preventDefault();

                let email = $("#email").val().trim();
                let password = $("#password").val().trim();
                let isValid = true;

                if (!email.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
                    toastr.error("Invalid email format.");
                    isValid = false;
                }

                if (password === "") {
                    toastr.error("Password cannot be empty.");
                    isValid = false;
                }

                if (isValid) {
                    $.ajax({
                        url: "../dbFunctions/adminLoginVerify.php",
                        type: "POST",
                        data: { email: email, password: password },
                        success: function (response) {
                            console.log("Server Response:", response);

                            if (response.trim() === "success") {
                                toastr.success("Login successful! Redirecting...");
                                setTimeout(() => {
                                    window.location.href = "./index.php";
                                }, 3000);
                            } else if (response.trim() === "Email not registered") {
                                toastr.error("Email not registered.");
                            } else if (response.trim() === "Password Incorrect") {
                                toastr.error("Incorrect password.");
                            } else {
                                toastr.error(response);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("AJAX Error:", error);
                            toastr.error("An error occurred. Please try again.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>