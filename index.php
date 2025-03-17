<?php
include_once "./fragment/navbar.php";
require_once "./dbFunctions/landingPagedb.php";
?>
    <section class="position-relative d-flex align-items-center">
        <!-- carausal Section  -->
        <section class="hero d-flex align-items-center">
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
                        <div class="carousel-item ">
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
                        <div class="carousel-item ">
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
    </section>
        <!-- Food Section Start -->
    <section class="food-section bg-body my-4" id="food">
            <div class="container">
                <div class=" py-3 mb-1">
                    <h2 class="fs-1 text-center">Foods</h2>
                </div>
                <div class="row g-2">
                <?php
                    $result = getRandomFoods();
                    while($food = $result->fetch_assoc()){
                        ?>
                        <div class="col-sm-6 col-lg-4 p-4">
                            <div class="p-0 bg-dark border border-1 rounded-4 overflow-hidden">
                                <div class="d-flex justify-content-center bg-body-tertiary border-radius-45 p-3">
                                    <!-- <img src='../uploads/<?= $food['image']?>' alt="" class="img-fluid"> -->
                                    <img src="./assets/images/f2.png" alt="" class="img-fluid">
                                </div>
                                <div class="details text-white px-4 mt-3">
                                    <h4><?= $food['name']?></h4>
                                    <p class="description mt-3 text-truncate-2 text-justify" style="font-size: 14px;">
                                        <?php 
                                            $desc = $food['description']; 
                                            echo $desc;
                                        ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between px-4 pb-2">
                                    <h4 class="text-warning">Rs. <?= $food['price']?></h4>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                ?>

                </div>
            </div>
    </section>
<?php
include_once "fragment/feedback.php";
include_once "fragment/customerFeedback.php";
include_once "fragment/footer.php";
?>