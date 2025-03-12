<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Registration</title>
    <link rel="stylesheet" href="styleReg.css">
    <!-- <link href="./bootstrap/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <!-- Progress Bar -->
    <div>
        <h2>Student Registration</h2>
    </div>
    <div class="progress-bar">
        <div class="progress-line"></div>
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
    </div>

    <!-- Step 1: SIC Input & OTP Verification -->
    <div class="form-step active" id="step-1">
        <h2>Step 1: Verify Identity</h2>
        <form id="sicVerification">
            <div id="sic-section">
                <input type="text" id="sic" placeholder="Enter SIC">
                <button id="next-btn">Next</button>
            </div>
        
            <div id="otp-section" style="display: none;">
                <input type="text" id="otp" placeholder="Enter OTP">
                <button id="verify-btn">Verify OTP</button>
            </div>
        </form>
    </div>

    <!-- Step 2: Additional Registration -->
    <div class="form-step" id="step-2">
        <h2>Step 2: More Registration Details</h2>
        <p>Further registration fields will be here.</p>
        <button id="next-step-2">Next</button>
    </div>

    <!-- Step 3: Final Step -->
    <div class="form-step" id="step-3">
        <h2>Step 3: Finalize Registration</h2>
        <p>Final details before completion.</p>
        <button id="finish-btn">Finish</button>
    </div>
</div>

<script src="studentReg.js"></script>
<!-- <script src="./bootstrap/bootstrap.bundle.min.js"></script> -->
</body>
</html>
