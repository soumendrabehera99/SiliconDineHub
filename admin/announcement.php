<?php 
include_once "adminNavbar.php";
?>

<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-2">Announcement</h2>

        <!-- Form -->
        <form id="announcementForm">
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-6">
                    <div class="mb-1">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
        
                    <div class="mb-1">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control summernote" id="message" name="message" required></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-1">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" required>
                    </div>
                    <div class="mb-1">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" required>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Add Announcement</button>
                        <button type="button" class="btn btn-danger" id="cancelEdit" style="display:none;">Cancel Edit</button>
                    </div>
                </div>
            </div>
        </form>
        <h5 class="mt-1">Existing Announcements</h5>
        <!-- Table -->
        <div class="table-responsive" style="height: 200px; overflow-y: auto;">
            <table class="table table-bordered mt-1" id="announcementTable">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="announcementData">
                    <!-- Dynamic data -->
                </tbody>
            </table>
        </div>

    </div>
</section>

<?php include_once "adminFooter.php"; ?>

<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<!-- Custom JS -->
<script src="../assets/js/announcementAjax.js"></script>

