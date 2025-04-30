<?php
include_once "./fragment/navbar.php";
require_once "./dbFunctions/landingPagedb.php";
?>
    <a href="#home">
        <div class="right-buttom d-flex justify-content-center align-items-center text-dark">
            <i class="fa-solid fa-arrow-up"></i>
        </div>
    </a>
    <div id="stickyBox" class="right-buttom-box d-flex">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" onclick="closeStickyBox()" aria-label="Close"></button>
        <div class="mt-3">
            <h5 id="stickyTitle" class="fw-bold fs-5"></h5>
            <p id="stickyMessage" class="small"></p>
        </div>
    </div>

    <!-- carausal Section  -->
    </section><section class="hero d-flex align-items-center" id="home">
        <div id="carouselExampleAutoplaying" class="carousel slide w-100" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 p-3 text-justify">
                                <div class="details text-white p-5">
                                    <h1>Good Food, Good Mood!</h1>
                                    <p>Great food makes a great day! Our cafeteria serves fresh, hygienic, and budget-friendly meals to keep you energized. Whether it’s a quick bite or a full meal, we’ve got you covered! 🍽️✨</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 p-3 text-justify">
                                <div class="details text-white p-5">
                                    <h1>No More Waiting in Long Queues!</h1>
                                    <p>Pre-book your meal and pick it up hassle-free! Save time and enjoy your break to the fullest. ⏳🍕</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 p-3 text-justify">
                                <div class="details text-white p-5">
                                    <h1>Multiple Counters for Fast Service</h1>
                                    <p>Collect your meal from your assigned counter and enjoy a smooth, stress-free dining experience. 🏃‍♂️🥗</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 p-3 text-justify">
                                <div class="details text-white p-5">
                                    <h1>Eat Smart, Spend Smarter!</h1>
                                    <p>Track your food expenses and manage your budget with ease. Your monthly meal history, all in one place! 📊💰</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Food Section Start -->
    <section class="food-section bg-body my-4 mx-4 mx-md-0" id="food">
        <div class="container my-3">
            <div class=" py-3 mb-1">
                <h2 class="fs-1 text-center">Foods</h2>
            </div>
            <div class="container my-1">
                <div class="row g-5 d-flex justify-content-between justify-content-start my-4 mx-2">
                    <!-- Repeat this block for each category -->
                    <?php 
                        $result = getAllCategory();
                        while($category = $result->fetch_assoc()){ ?>
                            <a href="./foodPlp.php?id=<?= $category['foodCategoryID']?>" class="col-3 p-2 col-md-2 col-lg-1 mx-3 my-1 text-decoration-none text-dark">
                                <div class="d-flex flex-column align-items-center category-item text-center p-1">
                                    <div class="p-2 m-2 rounded-circle" style="background-color: rgba(7, 61, 133, 0.17);">
                                        <!-- <img src="./assets/images/f2.png" alt="Category Image"> -->
                                        <img src='./uploads/<?= getFoodImageByCategoryId($category['foodCategoryID'])?>' alt="Category Image" class="rounded-circle object-fit-cover">
                                    </div>    
                                    <p class="mt-1 mb-0 text-truncate"><?= $category['category']?></p>
                                </div>
                            </a>
                        <?php
                        }
                    ?>
                </div>


                <!-- Our Best Selling products -->
                <div class="d-flex justify-content-between align-items-center mb-4 mb-md-3">
                    <h4 class="fw-bold">Our Best Selling Foods</h4>
                    <a href="./foodPlp.php" class="text-success fw-bold text-decoration-none">See All</a>
                </div>

                <!-- Bootstrap Carousel -->
                <div id="foodCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $result = getRandomFoods();
                        $active = "active"; // Set the first item as active
                        $count = 0;
                        ?>
                        <div class="carousel-item <?= $active ?>">
                            <div class="row g-4">
                                <?php
                                while ($food = $result->fetch_assoc()) {
                                    if ($count > 0 && $count % 6 == 0) { // 6 items per slide
                                        echo '</div></div><div class="carousel-item"><div class="row g-4">';
                                    }
                                    ?>
                                    <div class="col-md-2">
                                        <a href="./foodDetails.php?id=<?= $food['foodID'] ?>" class="text-decoration-none">
                                            <div class="card p-3 pb-0 shadow-none">
                                                <div class="position-relative">
                                                    <!-- <span class="badge-best text-white position-absolute rounded-1 top-0 start-0 m-2 px-2 py-1 bg-danger">Best Seller</span> -->
                                                    <!-- <img src="./assets/images/bun-and-hot-drink-delight.png" class="card-img-top img-fluid" alt="Product"> -->
                                                    <img src='./uploads/<?= $food['image']?>' alt="food Image" class="card-img-top img-fluid" style="object-fit: cover;">
                                                </div>
                                                <div class="card-body px-1">
                                                    <!-- Food Name and Veg Icon in One Line -->
                                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                                        <h6 class="fw-bold text-dark text-truncate mb-0"><?= $food['name'] ?></h6>
                                                        <?= $food['type']=="VEG"?
                                                        '<div style="border: 3px solid green; width: 20px; height: 20px; display: flex; justify-content: center; align-items: center;">
                                                            <div style="background-color: green; width: 10px; height: 10px; border-radius: 50%;"></div>
                                                        </div>':'<div style="border: 3px solid red; width: 20px; height: 20px; display: flex; justify-content: center; align-items: center;">
                                                            <div style="background-color: red; width: 10px; height: 10px; border-radius: 50%;"></div>
                                                        </div>' ?>
                                                    </div>
                                                    <p class="text-muted text-truncate-2 small"><?= $food['description']; ?></p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold text-dark">Rs. <?= $food['price'] ?></span>
                                                        <a href="./foodPlp.php" class="btn btn-outline-success btn-sm">ADD</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Navigation Buttons -->
                    <button class="carousel-control-prev custom-carousel-btn shadow-btn" type="button" data-bs-target="#foodCarousel" data-bs-slide="prev">
                        <span><i class="fas fa-chevron-left"></i></span>
                    </button>
                    <button class="carousel-control-next custom-carousel-btn shadow-btn" type="button" data-bs-target="#foodCarousel" data-bs-slide="next">
                        <span><i class="fas fa-chevron-right"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php
include_once "fragment/announcementNotice.php";
include_once "fragment/customerFeedback.php";
if (isset($_SESSION['sic'])) {
    include_once "fragment/feedback.php";
}
include_once "fragment/footer.php";
?>

<script src="./assets/js/index.js"></script>