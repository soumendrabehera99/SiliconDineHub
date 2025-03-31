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

    </style>
    <!--Toastr-->
    <link href="./assets/toastr/toastr.min.css" rel="stylesheet">
    
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
<script src="./assets/toastr/toastr.min.js"></script>
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
            positionClass: "toast-bottom-right",
            timeOut: 3000
        };

        $("#studentLoginForm").submit(function (e) {
            e.preventDefault();

            let sic = $("#sic").val().trim();
            let password = $("#password").val().trim();
            let isValid = true;

            if (sic === "") {
                toastr.error("SIC cannot be empty.");
                isValid = false;
            } else if (sic.length !== 8) {
                toastr.error("SIC must be 8 characters.");
                isValid = false;
            } else if (sic.match(/^\d{2}[a-zA-Z]{4}\d{2}$/) === null) {
                toastr.error("Enter valid sic");
                isValid = false;
            }
            if (password === "" || password === " ") {
                toastr.error("Password cannot be empty.");
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
                            console.log("Student login successfully.");
                            window.location.href = "./index.php";
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
