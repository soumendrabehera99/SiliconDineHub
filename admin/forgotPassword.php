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
                    <p class="text-white-50 text-center">Enter your email to reset your password</p>
                    
                    <form action="reset-password.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" id="email" class="form-control shadow-none text-white bg-transparent boder-warning">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">OTP</label>
                            <input type="text" id="otp" class="form-control shadow-none text-white bg-transparent boder-warning">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" id="otp" class="form-control shadow-none text-white bg-transparent boder-warning">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="text" id="otp" class="form-control shadow-none text-white bg-transparent boder-warning">
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
