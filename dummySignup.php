<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multi-Step Registration</title>
    <!-- <link rel="stylesheet" href="./assets/css/styleReg.css" /> -->
    <!-- <link href="./assets/bootstrap/bootstrap.min.css" rel="stylesheet"> -->
    <link href="./assets/toastr/toastr.min.css" rel="stylesheet" />
    <style>
      .progress-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 100%;
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
      }

      .step {
        width: 40px;
        height: 40px;
        background-color: lightgray;
        border-radius: 50%;
        line-height: 40px;
        font-size: 18px;
        color: white;
        text-align: center;
        font-weight: bold;
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .step.active {
        background-color: rgb(251, 119, 5);
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
      input {
        width: 30%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      button,
      #finish-btn {
        padding: 10px 15px;
        background-color: rgb(247, 119, 7);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
      }
      .toast {
          display: flex;
          align-items: center;
          box-shadow: none !important;
          padding-right: 30px !important; /* Ensures space for close button */
      }

      .toast-message {
          flex-grow: 1; /* Allows the message to take up remaining space */
          display: flex;
          align-items: center;
          justify-content: center; /* Centers only the message content */
      }

      .toast-close-button {
          position: absolute;
          right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container glassmorphism">
      <div>
        <h2>Student Registration</h2>
      </div>
      <div class="progress-bar">
        <div class="progress-line"></div>
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
      </div>

      <div class="form-step active" id="step-1">
        <h2>Step 1: Verify Identity</h2>
        <div id="sic-section">
          <label>Enter Your Sic</label>
          <input type="text" id="sic" placeholder="Enter SIC" /><br />
          <button id="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step" id="step-2">
        <h2>Step 2: OTP Verification</h2>
        <p id="otp"></p>
        <div id="otp-section">
          <input type="text" id="otpInput" placeholder="Enter OTP" />
          <button id="verify-btn">Verify OTP</button>
        </div>
        <button id="prev-btn1">Previous</button>
      </div>
      <form id="stuVerification">
        <div class="form-step" id="step-3">
          <h2>Step 3: Student Registration</h2>
          <input type="hidden" name="seID" id="seIDInput" />
          <input type="hidden" name="sic" id="sicInput" />
          <div class="mb-3">
            <label>Enter Your Name</label>
            <input type="text" id="name" name="name" />
          </div>
          <div class="mb-3">
            <label>Enter Your DOB</label>
            <input type="date" id="dob" name="dob" />
          </div>
          <div class="mb-3">
            <label>Enter Your Password</label>
            <input type="password" id="password" name="password" />
          </div>
          <div class="btn-div">
            <button id="prev-btn2">Previous</button>
            <button type="submit " id="finish-btn">Submit</button>
          </div>
        </div>
      </form>
    </div>

    <script src="./assets/jquery/jquery-3.7.1.min.js"></script>
    <script src="./assets/toastr/toastr.min.js"></script>
    <script>
      toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "3000",
      };
    </script>
    <script src="./assets/js/studentReg.js"></script>
    <!-- <script src="./bootstrap/bootstrap.bundle.min.js"></script> -->
  </body>
</html>
