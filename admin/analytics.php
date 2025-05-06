<?php 
include_once "adminNavbar.php";
?>
<!-- Main Content -->
<section class="content w-100 p-4">
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h2 class="">Analytics Overview</h2>
            <select class="form-select w-auto" id="filterDuration">
                <option selected>Last 7 Days</option>
                <option>Last 15 Days</option>
                <option>Last 30 Days</option>
                <option>Last 90 Days</option>
            </select>
        </div>

        <!-- Top Selling Foods -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-semibold d-flex justify-content-between">
                    Top Selling Foods
                    <span class="small text-white-50" id="topSellingDuration">(Showing: Last 7 Days)</span>
                </div>
                <ul class="list-group list-group-flush" id="topSellingList">
                </ul>
            </div>
        </div>

        <!-- Least Selling Foods -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-semibold d-flex justify-content-between">
                    Least Selling Foods
                    <span class="small text-white-50" id="leastSellingDuration">(Showing: Last 7 Days)</span>
                </div>
                <ul class="list-group list-group-flush" id="leastSellingList">
                </ul>
            </div>
        </div>

        <!-- Feedback Section (Split into Good & Bad) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-semibold d-flex justify-content-between">
                    Good Feedbacks
                    <span class="small text-white-50" id="goodFeedBackDuration">(Showing: Last 7 Days)</span>
                </div>
                <div class="card-body" id="goodFeedbacks">
                    <!-- Good feedbacks will appear here -->
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-semibold d-flex justify-content-between">
                    Bad Feedbacks
                    <span class="small text-white-50" id="badFeedBackDuration">(Showing: Last 7 Days)</span>
                </div>
                <div class="card-body" id="badFeedbacks">
                    <!-- Bad feedbacks will appear here -->
                </div>
            </div>
        </div>

    </div>
</section>
<?php include_once "adminFooter.php";?>
<script src="../assets/js/analytics.js"></script>