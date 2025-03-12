<?php include_once "./fragment/navbar.php";?>
    <style>
        .full-div{
            height: 89vh;
            background-image: linear-gradient(to top right, #000000, #fff078); 
        }
        .row {
            height: 70vh;
        }
        .form-div {
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body>

<div class="full-div">
    <div class="container h-100 d-flex align-items-center justify-content-center text-white">
        <div class="row shadow-lg rounded w-100 overflow-hidden gx-5 bg-transparent">
            <div class="col-md-6 d-none d-md-block">
                <img src="./assets/images/login-i5.jpg" class="w-100 object-fit-contain h-100">
            </div>
            <div class="col-md-6 form-div">
                <div class="my-5">
                    <h2 class="mb-3 text-center">Log In</h2>
                    <form id="studentLogin">
                        <div class="mt-3">
                            <label class="mb-3 form-label">Enter Your Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>

                        <div class="mt-3">
                            <label class="mb-3 form-label">Enter Your Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="mt-3">
                            <input type="submit" value="LogIn" name="LogIn" class="btn btn-sm btn-warning py-2 form-control">
                        </div>
                    </form>
                    <div class="mt-3">
                        <p class="text-center">If you're a new customer <a href="#" class="text-decoration-none">Sign-Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
