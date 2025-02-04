<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Nav Bar</title>
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        a {
            color: white !important;
        }

        .active {
            color: goldenrod !important;
        }

        body {
            font-family: "Open Sans", sans-serif;
            background-color: #fff;
            overflow-x: hidden;
        }

        .header-section {
            background: linear-gradient(to  right, #0d0e10, #3a4245);
        }

        .navbar-toggler:focus,
        .navbar-toggler:active {
            border: none;
            outline: none;
            box-shadow: none;
        }

        .border-radius-45 {
            border-radius: 0 0 0 45px;
        }
    </style>
</head>

<body>
    <div class="header-section py-2">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="./assets/images/logo.png" alt="" class="img-fluid"
                            style="height: 80px;"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="text-white fs-1"><i class="fa-solid fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">FOODS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ABOUT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">FEEDBACK</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">CONTACT US</a>
                            </li>
                        </ul>
                        <div class="user_option d-flex gap-3 align-items-center">
                            <a href="#" class="nav-link fs-5 text-center"><i class="fa-solid fa-cart-shopping"></i></a>
                            <a href="#" class="nav-link fs-5"><i class="fa-solid fa-user"></i></a>
                            <a href="#" class="btn btn-outline-warning btn-sm">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
 