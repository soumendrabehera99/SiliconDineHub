<?php session_start();?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silicon Dine Hub</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="./assets/fontawesome/all.css" />
    <!-- sweetalert -->
    <link rel="stylesheet" href="./assets/sweetalert/sweetalert2.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/index.css">
    <!-- Fevicon -->
    <link rel="icon" href="./assets/images/fevicon_logo.png" type="image/x-icon">
    <!--Toastr-->
    <link href="./assets/toastr/toastr.min.css" rel="stylesheet">
    <!-- food plp css-->
    <link rel="stylesheet" href="./assets/css/foodPlp.css">
</head>

<body>
    <div class="header_section py-2 position-sticky top-0 z-1">
        <div class="container header-container">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./index.php"><img src="./assets/images/logo.png" alt="" class="img-fluid"
                    style="height: 50px;"></a>
                    <div class="d-flex justify-content-between ms-sm-5 align-items-center gap-2">
                        <div class="input-group">
                            <input type="search" name="search" id="search" class="form-control">
                            <button type="submit" class="btn btn-outline-secondary search-Btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="text-white fs-1"><i class="fa-solid fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./foodPlp.php">FOODS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#footer">ABOUT</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="user_option d-flex gap-3 align-items-center ms-auto">
                            <!-- <?php echo isset($_SESSION['sic']) ? '<a href="#" class="nav-link fs-5 text-center"><i class="fa-solid fa-bell"></i></a>' : ''; ?> -->
                            <?php echo isset($_SESSION['sic']) ? 
                                '<a href="./orderHistory.php" class="nav-link fs-5 text-center position-relative" id="order-icon">
                                    <i class="fa-solid fa-box"></i>
                                </a>' 
                                : ''; 
                            ?>
                            <?php echo isset($_SESSION['sic']) ? 
                                '<a href="#" class="nav-link fs-5 text-center position-relative">
                                    <i class="fa-solid fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" 
                                        id="cart-notification" style="background-color: rgb(243, 64, 64); font-size: 0.75rem; padding: 3px 5px;">
                                        2
                                    </span>
                                </a>' 
                                : ''; 
                            ?>
                            <?php echo isset($_SESSION['sic']) ? 
                                '<a href="./cart.php" class="nav-link fs-5 text-center position-relative" id="cart-icon">
                                    <i class="fa-solid fa-cart-shopping"></i>   
                                </a>' 
                                : ''; 
                            ?>

                            <?php echo isset($_SESSION['sic']) ? '<a href="./studentLogout.php" id="logoutBtn" class="btn btn-outline-warning btn-sm">LogOut</a>' : '<a href="./studentSignIn.php" class="btn btn-outline-warning btn-sm">LogIn</a>'; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
 