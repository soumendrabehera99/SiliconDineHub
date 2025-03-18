<?php
include_once "./fragment/navbar.php";
?>
<main class="d-flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="p-3">
        <div id="category-bar" class="nav flex-column align-items-center">
        </div>
    </aside>

    <!-- Main Content -->
    <section class="food-section-plp" id="food">
        <div class="mx-auto inner-div">
            <div class="row g-3" id="fooddisplaydiv"></div>
        </div>
    </section>
</main>

<?php
include_once "./fragment/footer.php";
?>
<script src="./assets/js/foodPlp.js"></script>