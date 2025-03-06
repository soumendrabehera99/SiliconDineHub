
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page with Image Slider</title>
    <link href="./assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            background-color: rgb(245, 245, 245);
            /*background-image: url("./Images/Food-bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;*/
            color: orange;
        }
        .container {
            max-width: 1000px;
            margin-top: 12px;
        }
        .left-side {
            position: relative;
            height: 100%;
        }
        .carousel-item img {
            height: 100vh;
            object-fit: cover;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            text-align: center;
            color: white;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        /*.btn-custom {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
        }*/
        .right-side {
            background-color: black;
            padding: 50px;
        }
        .btn-purple {
            background-color: #7D5FFF;
            color: white;
            width: 100%;
        }
        /*.btn-social {
            background: #2C2C38;
            color: white;
            width: 48%;
        }*/
    </style>
</head>
<body>

<div class="container border border-5 border-warning rounded-3 shadow  mb-5 bg-body rounded">
    <div class="row shadow-lg rounded">
        <!-- Left Side (Image Slider) -->
        <div class="col-md-6 left-side p-0 d-none d-md-block">
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-start">
                    <div class="carousel-item active">
                        <img src="./assets/images/Ice-Cream.jpg" class="d-block w-100" alt="Slide 1">
                        <div class="overlay">
                            <div class="logo">Silicon DineHub</div>
                            <h2>Fuel Your Day,<br> One Bite at a Time!</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/images/Mocktail.jpg" class="d-block w-100" alt="Slide 2">
                        <div class="overlay">
                            <div class="logo">Silicon DineHub</div>
                            <h2>Where Every Meal Feels Like Home</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/images/pexels-pixabay-461415.jpg" class="d-block w-100" alt="Slide 3">
                        <div class="overlay">
                            <div class="logo">Silicon DineHub</div>
                            <h2>Fresh Flavors, Great Conversations.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side (Sign-up Form) -->
        <div class="col-md-6 right-side rounded-end">
            <div class="my-5">
                <h2 class="mb-3 text-center">Log In</h2>
                <form id="studentLogin">
                    <div class="mt-3">
                        <label class="mb-3">Enter Your Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>

                    <div class="mt-3 position-relative">
                        <label class="mb-3">Enter Your Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div>
                        <input type="submit" value="LogIn" name="LogIn" class="btn btn-sm btn-warning mt-3 form-control">
                    </div>
                </form>
                <div class="mt-3">
                    <p class="text-center">If you're a new customer <a href="#" class="text-decoration-none text-light">Sign-Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
