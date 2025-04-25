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
                    <span class="small text-white-50">(Showing: Last 7 Days)</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        Chicken Biryani <span class="badge bg-success">150</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Veg Burger <span class="badge bg-success">138</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Masala Dosa <span class="badge bg-success">125</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Paneer Butter Masala <span class="badge bg-success">119</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Veg Thali <span class="badge bg-success">98</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Least Selling Foods -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-semibold d-flex justify-content-between">
                    Least Selling Foods
                    <span class="small text-white-50">(Showing: Last 7 Days)</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        Egg Roll <span class="badge bg-danger">5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Fruit Salad <span class="badge bg-danger">9</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Sambar Rice <span class="badge bg-danger">11</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Rava Dosa <span class="badge bg-danger">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Noodles <span class="badge bg-danger">14</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Feedback Section (Split into Good & Bad) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-semibold d-flex justify-content-between">
                    Good Feedbacks
                    <span class="small text-white-50">(Showing: Last 7 Days)</span>
                </div>
                <div class="card-body">
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Akash</strong> - “Loved the biryani!” 
                        <span class="badge bg-primary ms-2">Food</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Sneha</strong> - “Delivery staff was very polite.” 
                        <span class="badge bg-warning text-dark ms-2">Employee</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Neha</strong> - “Paneer was delicious!” 
                        <span class="badge bg-primary ms-2">Food</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Sneha</strong> - “Delivery staff was very polite.” 
                        <span class="badge bg-warning text-dark ms-2">Employee</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Neha</strong> - “Paneer was delicious!” 
                        <span class="badge bg-primary ms-2">Food</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-semibold d-flex justify-content-between">
                    Bad Feedbacks
                    <span class="small text-white-50">(Showing: Last 7 Days)</span>
                </div>
                <div class="card-body">
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Ravi</strong> - “Dining area needs more cleaning.” 
                        <span class="badge bg-danger ms-2">Cleanliness</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Rahul</strong> - “Hand wash station was not working.” 
                        <span class="badge bg-danger ms-2">Cleanliness</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Ravi</strong> - “Dining area needs more cleaning.” 
                        <span class="badge bg-danger ms-2">Cleanliness</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Rahul</strong> - “Hand wash station was not working.” 
                        <span class="badge bg-danger ms-2">Cleanliness</span>
                    </div>
                    <div class="mb-3 border-bottom pb-1">
                        <strong>Rahul</strong> - “Hand wash station was not working.” 
                        <span class="badge bg-danger ms-2">Cleanliness</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<?php include_once "adminFooter.php";?>
