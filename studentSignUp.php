<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Registration with Circular Progress</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .step { display: none; }  /* Hide all steps by default */
        .step.active { display: block; }  /* Show only active step */
        
        /* Circular Progress Indicator */
        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #555;
        }
        .circle.active {
            background: #28a745;
            color: white;
        }
        .line {
            width: 50px;
            height: 4px;
            background: #ddd;
            flex-grow: 1;
        }
        .line.active {
            background: #28a745;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Registration</h2>

        <!-- Circular Progress Indicator -->
        <div class="progress-container d-flex align-items-center">
            <div class="circle active">1</div>
            <div class="line"></div>
            <div class="circle">2</div>
            <div class="line"></div>
            <div class="circle">3</div>
        </div>

        <!-- Registration Form -->
        <div class="card p-4 shadow">
            <form id="multiStepForm">
                <!-- Step 1 -->
                <div class="step active">
                    <h5>Step 1: Personal Information</h5>
                    <input type="text" class="form-control my-2" placeholder="Full Name" required>
                    <input type="email" class="form-control my-2" placeholder="Email" required>
                    <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                </div>

                <!-- Step 2 -->
                <div class="step">
                    <h5>Step 2: Address Details</h5>
                    <input type="text" class="form-control my-2" placeholder="Address" required>
                    <input type="text" className="form-control my-2" placeholder="City" required>
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                </div>

                <!-- Step 3 -->
                <div class="step">
                    <h5>Step 3: Password Setup</h5>
                    <input type="password" class="form-control my-2" placeholder="Password" required>
                    <input type="password" class="form-control my-2" placeholder="Confirm Password" required>
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".step");
        const circles = document.querySelectorAll(".circle");
        const lines = document.querySelectorAll(".line");

        function showStep(step) {
            steps.forEach((el, index) => {
                el.classList.toggle("active", index === step);
            });

            circles.forEach((circle, index) => {
                circle.classList.toggle("active", index <= step);
            });

            lines.forEach((line, index) => {
                line.classList.toggle("active", index < step);
            });
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        document.getElementById("multiStepForm").addEventListener("submit", function(event) {
            alert("Registration Completed Successfully!");
            event.preventDefault();
        });

        showStep(currentStep);
    </script>
</body>
</html>
