<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Faculty Login</title>
  <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet"/>
  <link href="../assets/toastr/toastr.min.css" rel="stylesheet"/>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: url('../assets/images/signupBgImg.webp') no-repeat center center fixed;
      background-size: cover;
    }

    .hero-section {
      min-height: 100vh;
      width: 100%;
      z-index: 1;
      position: relative;
      background-color: rgba(0, 0, 0, 0.4); /* optional dark overlay */
    }

    .content {
      z-index: 2;
    }

    .form-box {
      padding: 10px 25px 25px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .form-box input {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <section class="hero-section d-flex justify-content-center align-items-center text-white text-center">
    <div class="container content">
      <img src="../assets/images/logo.png" alt="Logo" class="mb-4" style="width: 300px;" />
      <h1 class="mb-2 fw-bold">Discover the New Way to Love Food</h1>
      <p class="mb-4 fs-5">Best Service, Best Food & Best Atmosphere!</p>

      <div class="form-box mx-auto text-dark bg-white text-center" style="max-width: 400px;">
        <div class="text-center mb-3">
          <h3>Faculty Login</h3>
        </div>
        <form id="facultyLoginForm">
          <input type="text" class="form-control" placeholder="Enter your SIC" id="sic"/>
          <input type="password" class="form-control" placeholder="Enter your password" id="password" />
          <button type="submit" class="btn btn-warning w-100 mt-2">Login</button>
        </form>
      </div>
    </div>
  </section>

  <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../assets/jquery/jquery-3.7.1.min.js"></script>
  <script src="../assets/toastr/toastr.min.js"></script>
  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "timeOut": "3000"
    };

    $('#facultyLoginForm').on('submit', function (e) {
      e.preventDefault();

      const sic = $('#sic').val();
      const password = $('#password').val();

      if (!sic || !password) {
        toastr.error("All fields are required");
        return;
      }

      const data = {
        sic: sic,
        password: password
      };

      $.ajax({
        type: 'POST',
        url: '../dbFunctions/facultyLoginDb.php',
        data: data,
        success: function (response) {
          console.log(response);
          if(res.status == "Not present"){
            toastr.error("Facult not found.");
          }
          else if (res.status === 'success') {
            toastr.success("Login Successful");
            window.location.href = '../index.php';
          } else if(res.status === 'passwordError'){
            toastr.error("Incorrect password"); 
          }
        },
        error: function () {
          toastr.error("Login failed");
        }
      });
    });
  </script>  
</body>
</html>
