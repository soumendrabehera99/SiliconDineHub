<?php
include_once "./fragment/navbar.php";
?>
<main class="d-flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="p-1">
        <div id="category-bar" class="nav ms-3">
        </div>
    </aside>
    <div id="cafeteriaPopup" style="
        display: none;
        position: fixed;
        transform: translateX(-50%);
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        z-index: 9999;
        font-weight: bold;
    ">
        Cafeteria is closed
    </div>
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
<script>
$(document).ready(function () {

    // popup position adjustment
    function adjustPopupPosition() {
        if (window.innerWidth <= 576) {
            $('#cafeteriaPopup').css({
                'top': '15%',
                'left': '43%',
                'transform': 'none'
            });
        } else {
            $('#cafeteriaPopup').css({
                'top': '20%',
                'left': '50%',
                'transform': 'translateX(-50%)'
            });
        }
    }

    adjustPopupPosition(); // Initial adjustment
    $(window).on('resize', adjustPopupPosition); // Update on resize


    // Add grayscale effect to food cards if cafteria is closed
    $.get('./dbFunctions/cafeteriaStausAjax.php', { operation: 'getStatus' }, function (data) {
        if (data.success && data.is_open == 0) {
            $('#cafeteriaPopup').fadeIn(400);

            const applyGreyOut = () => {
                $('#fooddisplaydiv .food-card').css({
                    'pointer-events': 'none',
                    'opacity': '0.4',
                    'filter': 'grayscale(100%)'
                });
            };

            // Run every 500ms for 5 seconds to catch delayed rendering
            let attempts = 0;
            const intervalId = setInterval(() => {
                const cards = $('#fooddisplaydiv .food-card');
                if (cards.length > 0) {
                    applyGreyOut();
                    attempts++;
                    if (attempts >= 10) clearInterval(intervalId); // stop after 2s
                }
            }, 200);

            // Optional fallback after 3 seconds in case MutationObserver fails
            setTimeout(() => {
                applyGreyOut();
            }, 2000);
        }
    }, 'json');
});
</script>
