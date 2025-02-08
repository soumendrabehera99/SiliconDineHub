<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <style>
        .profile-card {
            background: linear-gradient(135deg, #007bff, #6610f2);
        }
        .profile-img {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }
        .nav-tabs .nav-link {
            color: #333;
        }
        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom: 3px solid #007bff;
        }
    </style>
    <div class="row">
        <div class="col">
            <span class="text-dark fs-5">Profile</span>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="profile-card p-4 text-center rounded-4 text-white shadow">
                <img id="profileImage" src="../assets/images/profile.jpg" class="profile-img mb-3 rounded-circle border border-5 border-white" alt="Admin Profile Picture">
                <h4>Asish Sahu</h4>
                <p>Restaurant Administrator</p>
                <div>
                    <a href="#" class="me-2 text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2 text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-2 text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card rounded-4 shadow p-4 border h-auto mb-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showTab('overview')">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showTab('edit-profile')">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showTab('change-password')">Change Password</a>
                    </li>
                </ul>
                
                <div class="mt-4">
                    <div id="overview" class="tab-content">
                        <h5>Profile Details</h5>
                        <table class="table">
                            <tbody>
                                <tr><th>Name</th><td>Asish Sahu</td></tr>
                                <tr><th>Restaurant</th><td>Silicon DineHub</td></tr>
                                <tr><th>Phone</th><td>1234567890</td></tr>
                                <tr><th>Email</th><td>admin@asish.com</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="edit-profile" class="tab-content d-none">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="Asish Sahu">
                            </div>                        
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="1234567890">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="admin@asish.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <div class="input-group">
                                    <input type="file" id="fileInput" class="form-control" accept="image/jpeg, image/png" onchange="previewImage(event)">
                                    <label class="input-group-text" for="fileInput">Upload</label>
                                </div>
                            </div>
                            <div class="text-end">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </form>
                    </div>

                    <div id="change-password" class="tab-content d-none">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="text-end">
                                <input type="submit" class="btn btn-primary" value="Update Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('d-none');
            });
            document.getElementById(tabId).classList.remove('d-none');

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profileImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</div>

<?php include_once "adminFooter.php";?>