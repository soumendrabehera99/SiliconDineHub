<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter Dashboard</title>
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/sweetalert/sweetalert2.css" />
    <!-- Fevicon -->
    <link rel="icon" href="./assets/images/fevicon_logo.png" type="image/x-icon">
    <style>
        body{
            background-color: #e1e7fe
        }
        .wrapper {
            width: 70%;
        }

        .form-control:focus {
            box-shadow: none !important;
            border-color: goldenrod !important;
        }

        .form-control {
            border: 1px solid goldenrod;
            border-radius: 16px;
        }

        h2 {
            font-family: "Open Sans", sans-serif;
        }
        @media (max-width: 768px) { 
            .custom-rounded {
                border-radius: 10px; /* Circle on mobile */
            }
        }
    </style>

    <body class="text-white d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container d-flex align-items-center justify-content-center" style="height: 90vh">
            <div class="row rounded g-0 wrapper">
                <div class="col-md-6 d-none d-md-block">
                    <img src="./assets/images/rotiMaking.jpg" class="img-fluid rounded-start" alt="Login">
                </div>
                <div class="col-md-6 bg-white text-dark d-flex align-items-center justify-content-center p-4 custom-rounded">
                    <div>
                        <a href="./index.php"><img src="./assets/images/logo_black.png" alt="Logo" class="img-fluid mb-4" style="width: 370px; height: auto;"></a>
                        <h2 class="text-center mb-4">Counter Staff Login</h2>
                        <form id="counterLoginForm" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-warning px-5 py-2" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="./assets/jquery/jquery-3.7.1.min.js"></script>
        <script src="./assets/sweetalert/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#counterLoginForm").submit(function (e) {
                    e.preventDefault();

                    let username = $("#username").val().trim();
                    let password = $("#password").val().trim();

                    if (username === "" || password === "") {
                        Swal.fire("Error", "Both fields are required!", "error");
                        return;
                    }

                    $.ajax({
                        url: "./dbFunctions/counterLogindb.php",
                        type: "POST",
                        data: { username: username, password: password },
                        success: function (response) {
                            let res = response.trim();

                            if (res === "success") {
                                Swal.fire({
                                    title: "Login Successful",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "./counterDashboard.php";
                                });
                            } else {
                                Swal.fire("Error", res, "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error", "Server error. Try again later.", "error");
                        }
                    });
                });
            });
        </script>
    </body>
</html>
