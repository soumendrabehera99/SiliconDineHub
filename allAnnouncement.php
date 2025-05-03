<?php
include_once "./fragment/navbar.php";
?>
    <section class="mb-5">
        <div class="container w-75">
            <div class="py-1 mb-3">
                <h2 class="text-center fs-1">Announcements</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <!-- Announcement content Ajax call it here -->
                    <div id="fetchAllAnnouncements"></div>
                </div>
            </div>
        </div>
    </section>
<?php
include_once "./fragment/footer.php";
?>
