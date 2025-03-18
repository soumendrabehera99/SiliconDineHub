<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multi-Step Registration</title>
    <link href="./assets/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/toastr/toastr.min.css" rel="stylesheet" />
    <link href="./assets/sweetalert/sweetalert2.css" rel="stylesheet" />
    <!-- Fevicon -->
    <link rel="icon" href="./assets/images/fevicon_logo.png" type="image/x-icon">
    <style>
      body {
        background-image: url('./assets/images/signupBgImg.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .progress-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 100%;
        height: 50px;
        margin: 20px auto;
        padding: 10px 0;
      }

      .progress-bar::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: lightgray;
        transform: translateY(-50%);
        z-index: 0;
      }

      .progress-line {
        position: absolute;
        top: 50%;
        left: 0;
        width: 0%;
        height: 4px;
        background-color: orangered;
        transform: translateY(-50%);
        transition: width 0.3s ease-in-out;
        z-index: 0;
      }

      .step {
        width: 40px;
        height: 40px;
        background-color: lightgray;
        border-radius: 50%;
        font-size: 18px;
        color: white;
        text-align: center;
        font-weight: bold;
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;        
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
      }

      .step:nth-child(2) {
        left: 0%;
      }

      /* Position Step 2 at the center */
      .step:nth-child(3) {
        left: 50%;
        transform: translate(-50%, -50%);
      }

      /* Position Step 3 at the end */
      .step:nth-child(4) {
        right: 0%;
      }


      .step.active{
        background-color: rgb(251, 119, 5);

      }
      .btn {
          background-color: rgb(251, 119, 5) !important;
          color: white !important;
          border: none;
      }

      .btn:hover {
          background-color: rgb(230, 100, 0) !important; /* Darker shade on hover */
          color: white !important;
      }

      .form-step {
        display: none;
      }

      .form-step.active {
        display: block;
      }

      label {
        font-size: 18px;
      }
      .card {
            width: 70%; /* Default: 70% width for mobile */
            max-width: 100%; /* Ensures it doesn’t exceed the screen width */
            margin: 0 auto; /* Centers the card */
            padding: 16px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
            border-radius: 8px;
        }

        /* Apply 50% width on screens wider than 768px (tablets & desktops) */
        @media (min-width: 768px) {
            .card {
                width: 50%;
            }
        }

    </style>
  </head>
  <body class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="card p-4 shadow mx-auto">
      <h2 class="text-center">Student Registration</h2>
      
      <div class="progress-bar">
        <div class="progress-line"></div>
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
      </div>

      <!-- Step 1: Verify Identity -->
      <div class="form-step active" id="step-1">
        <h4>Step 1: Verify Identity</h4>
        <div class="row mb-3 mt-4">
          <div class="col-md-4">
            <label for="sic" class="form-label">Enter Your SIC</label>
          </div>
          <div class="col-md-8">
            <input type="text" id="sic" class="form-control" placeholder="Enter SIC" />
          </div>
        </div>
        <div class="d-flex justify-content-between mt-5">
          <a href="./index.php"><button class="btn" id="back-btn">Back</button></a>
          <button class="btn" id="next-btn">Next</button>
        </div>
      </div>

      <!-- Step 2: OTP Verification -->
      <div class="form-step" id="step-2">
        <h4>Step 2: OTP Verification</h4>
        <p id="otp"></p>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="otpInput" class="form-label">Enter OTP</label>
          </div>
          <div class="col-md-8">
            <input type="text" id="otpInput" class="form-control" placeholder="Enter OTP" />
          </div>
        </div>
        <div class="d-flex justify-content-between mt-5">
          <button class="btn" id="prev-btn1">Previous</button>
          <button class="btn" id="verify-btn">Verify OTP</button>          
        </div>
      </div>

      <!-- Step 3: Student Registration -->
      <form id="stuVerification">
        <div class="form-step" id="step-3">
          <h4>Step 3: Student Registration</h4>
          <input type="hidden" name="seID" id="seIDInput" />
          <input type="hidden" name="sic" id="sicInput" />
          
          <div class="row mb-3 mt-4">
            <div class="col-md-4">
              <label for="name" class="form-label">Enter Your Name</label>
            </div>
            <div class="col-md-8">
              <input type="text" id="name" name="name" class="form-control" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="dob" class="form-label">Enter Your DOB</label>
            </div>
            <div class="col-md-8">
              <input type="date" id="dob" name="dob" class="form-control" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="password" class="form-label">Enter Your Password</label>
            </div>
            <div class="col-md-8">
              <input type="password" id="password" name="password" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="password" class="form-label">Confirm Password</label>
            </div>
            <div class="col-md-8">
              <input type="text" id="cpassword" name="cpassword" class="form-control" />
            </div>
          </div>
          <div class="d-flex justify-content-between mt-5">
            <button class="btn" id="prev-btn2">Previous</button>
            <button type="submit" class="btn">Submit</button>
          </div>
        </div>
      </form>
    </div>

    <script src="./assets/jquery/jquery-3.7.1.min.js"></script>
    <script src="./assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./assets/toastr/toastr.min.js"></script>
    <script src="./assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="./assets/js/studentReg.js"></script>
  </body>
</html>
