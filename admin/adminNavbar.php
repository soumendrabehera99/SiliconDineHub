<?php
session_start();
include_once "./check.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="./../assets/bootstrap/bootstrap.min.css" rel="stylesheet" />

  <!-- Fontawesome -->
  <link rel="stylesheet" href="./../assets/fontawesome/all.css">
  
  <!-- fevicon -->
  <link rel="icon" href="./../assets/images/fevicon_logo.png" type="image/x-icon">

  <!-- Custom Styles -->
  <link href="./../assets/css/AdminCss/style.css" rel="stylesheet" />
  <link href="./../assets/css/AdminCss/foodManage.css" rel="stylesheet" />
  <!--Toastr-->
  <link href="./../assets/toastr/toastr.min.css" rel="stylesheet">
  
  <!-- Summer note -->
  <link href="./../assets/summernote/summernote-bs4.min.css" rel="stylesheet">
  <style>
    #cafeteriaToggle {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #ccc; 
        cursor: pointer;
        transition: background-color 0.3s ease;
        outline: 2px solid #ffc107;
    }

    #cafeteriaToggle:checked {
        background-color: #ffc107;
    }
  </style>

</head>

<body>
  <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="btn btn-dark" id="sidebarToggler">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a class="navbar-brand ps-3" href="./index.php">
                <img src="./../assets/images/logo.png" alt="logo" />
            </a>
            
            <div class="d-flex justify-content-center align-items-center ms-auto">
                <div class="me-3 position-relative">
                    <div href="" class="text-decoration-none btn btn-warning" id="changePasswordBtn">
                        Change Password
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside class="sidebar bg-dark text-white d-flex flex-column justify-content-between position-fixed top-0 start-0 min-vh-100">
        <div>
            <div>
                <a href="./index.php" class="mt-3 text-white text-decoration-none d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-tachometer-alt me-3"></i>Dashboard</div>
                </a>
            </div>

            <div>
                <a href="#customer" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                    <div><i class="fa-solid fa-user me-3"></i> Customer</div> 
                    <i class="fa-solid fa-chevron-right toggle-icon"></i>
                </a>
                <div class="collapse ms-5" id="customer">
                    <a href="./customerAdd.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Customer</a>
                    <a href="./customerManage.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Customer</a>
                    <a href="./customerValid.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Valid Customer</a>
                </div>
            </div>

            <div>
                <a href="#foodCategory" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                    <div><i class="fa-solid fa-layer-group me-3"></i>Food Category</div>
                    <i class="fa-solid fa-chevron-right toggle-icon"></i>
                </a>
                <div class="collapse ms-5" id="foodCategory">
                    <a href="./manageCategory.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Category</a>
                </div>
            </div>

            <div>
                <a href="#food" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                    <div><i class="fa-solid fa-burger me-3"></i> Food</div> 
                    <i class="fa-solid fa-chevron-right toggle-icon"></i>
                </a>
                <div class="collapse ms-5" id="food">
                    <a href="./addFood.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Food</a>
                    <a href="./manageFood.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Food</a>
                </div>
            </div>

            <div>
                <a href="#counter" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                    <div><i class="fa-solid fa-utensils me-3"></i> Counter</div> 
                    <i class="fa-solid fa-chevron-right toggle-icon"></i>
                </a>
                <div class="collapse ms-5" id="counter">
                    <!-- <a href="./counterAdd.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Counter</a> -->
                    <a href="./counterManage.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Counter</a>
                </div>
            </div>

            <div>
                <a href="./announcement.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                    <div><i class="fa-solid fa-bullhorn me-3"></i> Announcement</div>
                </a>
            </div>

            <div>
                <a href="./analytics.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-chart-line me-3"></i> Analytics</div>
                </a>
            </div>

            <div>
                <a href="./report.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-file-invoice me-3"></i> Report</div>
                </a>
            </div>
            <div class="d-flex align-items-center text-white px-3 py-2">
                <div class="form-check form-switch m-0">
                    <input class="form-check-input" type="checkbox" id="cafeteriaToggle">
                    <label class="form-check-label ms-2" for="cafeteriaToggle" id="cafeteriaStatus">Cafeteria Open</label>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <a href="#" id="logoutBtn" class="text-decoration-none d-flex align-items-center justify-content-between w-100" style="color: #adb5bd;">
                <h5 class="my-0">Logout</h5>
                <div><i class="fa-solid fa-arrow-right-from-bracket mx-2"></i></div>
            </a>
        </div>
    </aside>

<script src="../assets/jquery/jquery-3.7.1.min.js"></script>
<script>
function updateStatusUI(isOpen) {
    $('#cafeteriaToggle').prop('checked', isOpen == 1);
    $('#cafeteriaStatus').text(isOpen == 1 ? 'Cafeteria Close' : 'Cafeteria Open');
    showStatusInSweetAlert(isOpen);
}

function showStatusInSweetAlert(isOpen) {
    // Show SweetAlert with the current status
    Swal.fire({
        icon: isOpen == 1 ? 'success' : 'error',
        title: isOpen == 1 ? 'Cafeteria Open' : 'Cafeteria Closed',
        text: isOpen == 1 ? 'Silicon DineHub is now open.' : 'Silicon DineHub is now closed.',
        showConfirmButton: true,
        confirmButtonText: 'OK'
    });
}

$(document).ready(function () {
    // Get current status
    $.get('../dbFunctions/cafeteriaStausAjax.php', { operation: 'getStatus' }, function (data) {
        if (data.success) {
            updateStatusUI(data.is_open);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + data.error
            });
        }
    }, 'json');

    // Handle toggle
    $('#cafeteriaToggle').change(function () {
        const isOpen = $(this).is(':checked') ? 1 : 0;
        updateStatusUI(isOpen);

        $.ajax({
            url: '../dbFunctions/cafeteriaStausAjax.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ operation: 'update', is_open: isOpen }),
            success: function (res) {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'The status has been successfully updated.'
                    });
                } else if (res.success == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: ' + res.error
                    });
                }
            },
            error: function () {
                // Failure message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Connection Error',
                    text: 'Failed to connect to the server.'
                });
            }
        });
    });
});

document.getElementById("logoutBtn").addEventListener("click", function(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "You will be logged out!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Logout!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./adminLogout.php"; // Redirect if confirmed
        }
    });
});
$('#changePasswordBtn').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Change Password',
        html:
            `<input type="password" id="currentPassword" class="swal2-input" placeholder="Current Password">
             <input type="password" id="newPassword" class="swal2-input" placeholder="New Password">`,
        focusConfirm: false,
        confirmButtonText: 'Submit',
        showCancelButton: true,
        preConfirm: () => {
        const currentPassword = Swal.getPopup().querySelector('#currentPassword').value.trim();
        const newPassword = Swal.getPopup().querySelector('#newPassword').value.trim();

        if (!currentPassword || !newPassword) {
            Swal.showValidationMessage('All fields are required');
            return false;
        }

        return { currentPassword, newPassword };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
        const {currentPassword, newPassword } = result.value;

        $.ajax({
            url: '../dbFunctions/changeAdminPassword.php',
            type: 'POST',
            data: { currentPassword, newPassword },
            success: function (response) {
            try {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                Swal.fire('Success', res.message, 'success');
                } else {
                Swal.fire('Error', res.message, 'error');
                }
            } catch (e) {
                Swal.fire('Error', 'Invalid server response.', 'error');
            }
            },
            error: function () {
            Swal.fire('Error', 'AJAX request failed.', 'error');
            }
        });
        }
    });
});
</script>