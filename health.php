<?php
session_start();
include("connect.php");
if (isset($_SESSION['lastName'])) {
    echo "<script>
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('lastName', '" . $_SESSION['lastName'] . "');
        </script>";
} else {
    echo "<script>
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('lastName');
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Packages | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="health.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!--Top bar-->
    <section class="bar">
        <div class="emergency">
            <span>FOR EMERGENCY:</span>
            <span id="number">☎ +94 011 4000 300</span>
        </div>
        <div class="sign-in">
            <span id="userGreeting" style="display: none;">Hi, <span id="userLastName"></span></span>
            <button class="sign-in-btn" id="authButton" onclick="openPopup()">Sign In</button>
        </div>
    </section>

    <!--sign-in popup-->
    <section class="popup-container" id="signPopup">
        <div class="popup" id="signup" style="display: none;">
            <span class="close" onclick="closePopup()">&times;</span>
            <h1 class="form-tittle">Register</h1>
            <form method="post" action="register.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="fName" id="fName" placeholder="First Name" required>
                    <label for="fName">First Name</label>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                    <label for="lName">Last Name</label>
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <label for="emial">Email</label>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <div>
                    <input type="submit" class="submit-btn" value="Sign Up" name="signUp">
                </div>
            </form>
            <div class="links">
                <p>Already have account?</p>
                <button class="signBtn" id="signInButton">Sign In</button>
            </div>
        </div>

        <div class="popup" id="signIn">
            <span class="close" onclick="closePopup()">&times;</span>
            <h1 class="form-tittle">Sign In</h1>
            <form method="post" action="register.php">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email1" placeholder="Email" required>
                    <label for="emial">Email</label>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password1" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <div>
                    <input type="submit" class="submit-btn" value="Sign In" name="signIn">
                </div>
            </form>
            <div class="links">
                <p>Don't have account yet?</p>
                <button class="signBtn" id="signUpButton">Sign Up</button>
            </div>
        </div>
    </section>

    <!--Navigation bar-->
    <section class="nav-bar">
        <div class="logo">
            <img src="Img/Logo without background.png" alt="Care Compass Hospital Logo" width="80" height="80">
            <a><span>Care Compass Hospital</span></a>
        </div>

        <ul class="menu">
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.php">ABOUT US</a></li>
            <li><a href="">MEDICAL SERVICES</a>
                <ul class="sub-menu">
                    <li><a href="health.php">Health Packages</a></li>
                    <li><a href="channeling.php">Channeling Services</a></li>
                </ul>
            </li>
            <li><a href="">PATIENT PORTAL</a>
                <ul class="sub-menu">
                    <li><a href="mediRecords.php" onclick="checkLogin('mediRecords.php')">Medical Records</a></li>
                    <li><a href="labResult.php" onclick="checkLogin('labResult.php')">Lab Results</a></li>
                    <li><a href="appointment.php" onclick="checkLogin('appointment.php')"> Schedule an Appointment</a></li>
                    <li><a href="manageAppointment.php" onclick="checkLogin('manageAppointment.php')">Manage Appointment</a></li>
                    <li><a href="payment.php" onclick="checkLogin('payment.php')">Payment History</a></li>
                </ul>
            </li>
            <li><a href="contact.php">CONTACT US</a></li>
        </ul>
    </section>

    <!--Heading section-->
    <section class="heading-section">
        <div class="heading-content">
            <h1>Health Packages</h1>
            <hr>
        </div>
    </section>

    <!--Promotional Advertisement-->
    <section class="promo-ad">
        <div class="promo-content">
            <div class="promo-text">
                <h2>An extraordinary set of health packages for you to select</h2>
                <p>Your health is not always the same. With passing ages and life habits, you are almost liable to get
                    sick easily. Since prevention is better than cure, we at Care Compass Hospital offer you an
                    extraordinary set of health packages that fit your age at competitive prices. We aim to uphold the
                    highest standards when it comes to quality and safety. We know that you have a choice when it comes
                    to your healthcare provider, and we want you to feel good about your decision to entrust your care
                    to us.</p>
                <h3>Channel your Doctor</h3>
                <p>Make an appointment through our website.<br>
                    Visit the Care Compass Hospital website to easily book your doctor or to get more information
                    regarding our health packages.</p>
            </div>
            <div class="promo-image">
                <img src="Img/health.jpg" alt="Image">
            </div>
        </div>
    </section>

    <!--Health Packages Section-->
    <section class="health-packages">
        <div class="package">
            <h3>Basic Health Screening</h3>
            <ul>
                <li>Medical Examination</li><hr>
                <li>Body Mass Index (BMI)</li><hr>
                <li>Distant Vision</li><hr>
                <li>Full Blood Count</li><hr>
                <li>Blood Group</li><hr>
                <li>Fasting Blood Sugar</li><hr>
                <li>Lipid Profile</li><hr>
                <li>S. Creatinine</li><hr>
                <li>Urine Full Reports</li><hr>
                <li>E.C.G</li><hr>
                <li>Chest X-Ray</li><hr>
                <li class="disc">Discussion of reports will be done by Medical officer</li><hr><br>
            </ul>
            <p class="price">Price Rs. 4000/=</p>
        </div>

        <div class="package">
            <h3>General Health Screening</h3>
            <ul>
                <li>Medical Examination</li><hr>
                <li>Body Mass Index (BMI)</li><hr>
                <li>Distant Vision</li><hr>
                <li>Full Blood Count</li><hr>
                <li>Blood Group</li><hr>
                <li>Fasting Blood Sugar</li><hr>
                <li>Lipid Profile</li><hr>
                <li>S.G.P.T. / S.G.O.T</li><hr>
                <li>S. Creatinine</li><hr>
                <li>Blood Urea</li><hr>
                <li>Urine Full Reports</li><hr>
                <li>E.C.G</li><hr>
                <li>Chest X-Ray</li><hr>
                <li class="disc">Discussion of reports will be done by Medical officer</li><hr><br>
            </ul>
            <p class="price">Price Rs. 6000/=</p>
        </div>

        <div class="package">
            <h3>Well Man Health Screening</h3>
            <ul>
                <li>Medical Examination</li><hr>
                <li>Body Mass Index (BMI)</li><hr>
                <li>Distant Vision</li><hr>
                <li>Full Blood Count</li><hr>
                <li>E.S.R</li><hr>
                <li>Random Blood Sugar</li><hr>
                <li>S.G.P.T. / S.G.O.T</li><hr>
                <li>T.S.H. (Thyroid Test)</li><hr>
                <li>PSA (Prostate Specific Antigen)</li><hr>
                <li>Blood Urea</li><hr>
                <li>Urine Full Reports</li><hr>
                <li>Stool Full Report / Occult Blood</li><hr>
                <li>E.C.G</li><hr>
                <li>Chest X-Ray</li><hr>
                <li>Ultra Sound Scan of Abdomen</li><hr>
                <li class="disc">Discussion of reports will be done by Consultant Physician & Dietician</li><hr><br>
            </ul>
            <p class="price">Price Rs. 15,500/=</p>
        </div>

        <div class="package">
        <h3>Well Woman Health Screening</h3>
        <ul>
            <li>Medical Examination</li><hr>
            <li>Body Mass Index (BMI)</li><hr>
            <li>Distant Vision</li><hr>
            <li>Full Blood Count</li><hr>
            <li>E.S.R</li><hr>
            <li>Random Blood Sugar</li><hr>
            <li>S.G.P.T / S.G.O.T</li><hr>
            <li>T.S.H. (Thyroid Test)</li><hr>
            <li>PAP Smear</li><hr>
            <li>Urine Full Report</li><hr>
            <li>Stool Full Report / Occult Blood</li><hr>
            <li>E.C.G</li><hr>
            <li>Chest X-Ray</li><hr>
            <li>Ultra Sound Scan of the pelvis (TVS)</li><hr>
            <li class="disc">Discussion of reports will be done by Consultant Gynecologist & Dietician</li><hr><br>
        </ul>
        <p class="price">Price Rs. 13,000/=</p>
    </div>

    <div class="package">
        <h3>Premier Health Package (Below 40 years for Men & Women)</h3>
        <ul>
            <li>Medical Examination</li><hr>
            <li>Body Mass Index (BMI)</li><hr>
            <li>Distant Vision</li><hr>
            <li>Full Blood Count</li><hr>
            <li>E.S.R</li><hr>
            <li>Fasting Blood Sugar</li><hr>
            <li>Lipid Profile</li><hr>
            <li>Liver Profile</li><hr>
            <li>T.S.H. (Thyroid Test)</li><hr>
            <li>Post Prandial Blood Sugar</li><hr>
            <li>Urine Full Reports</li><hr>
            <li>E.C.G</li><hr>
            <li>Chest X-Ray</li><hr>
            <li>Ultra Sound Scan of Abdomen</li><hr>
            <li class="disc">Discussion of reports will be done by Consultant Physician</li><hr><br>
        </ul>
        <p class="price">Price Rs. 15,000/=</p>
    </div>

    <div class="package">
        <h3>Comprehensive Health Package (Above 40 years for Men & Women)</h3>
        <ul>
            <li>Medical Examination</li><hr>
            <li>Body Mass Index (BMI)</li><hr>
            <li>Distant Vision</li><hr>
            <li>Full Blood Count</li><hr>
            <li>E.S.R</li><hr>
            <li>Fasting Blood Sugar</li><hr>
            <li>Lipid Profile</li><hr>
            <li>Liver Profile</li><hr>
            <li>Renal Profile</li><hr>
            <li>T.S.H. (Thyroid Test)</li><hr>
            <li>Post Prandial Blood Sugar</li><hr>
            <li>Urine Full Reports</li><hr>
            <li>Stool Full Report + Occult Blood</li><hr>
            <li>E.C.G</li><hr>
            <li>Chest X-Ray</li><hr>
            <li>Ultra Sound Scan of Abdomen</li><hr>
            <li class="disc">Discussion of reports will be done by Consultant Physician</li><hr><br>
        </ul>
        <p class="price">Price Rs. 17,000/=</p>
    </div>

     <div class="package">
        <h3>Diabetic Health Package</h3>
        <ul>
            <li>Medical Examination</li><hr>
            <li>Body Mass Index (BMI)</li><hr>
            <li>Distant Vision</li><hr>
            <li>Fasting Blood Sugar</li><hr>
            <li>Lipid Profile</li><hr>
            <li>HbA1C</li><hr>
            <li>S.G.P.T</li><hr>
            <li>S.Creatinine</li><hr>
            <li>T.S.H. (Thyroid Test)</li><hr>
            <li>Urine for Micro Albumin</li><hr>
            <li>Urine Full Reports</li><hr>
            <li>E.C.G.</li><hr>
            <li>Ultra Sound Scan of Abdomen</li><hr>
            <li>Liver Profile</li><hr>
            <li>Renal Profile</li><hr>
            <li>Chest X-Ray</li><hr>
            <li class="disc">Discussion of reports will be done by Consultant Physician & Dietician</li><hr><br>
        </ul>
        <p class="price">Price Rs. 19,000/=</p>
    </div>

    <div class="package">
        <h3>Senior Citizen Health Screening</h3>
        <ul>
            <li>Medical Examination</li><hr>
            <li>Body Mass Index (BMI)</li><hr>
            <li>Distant Vision</li><hr>
            <li>Full Blood Count</li><hr>
            <li>E.S.R.</li><hr>
            <li>Fasting Blood Sugar</li><hr>
            <li>Lipid Profile</li><hr>
            <li>S.G.P.T/S.G.O.T</li><hr>
            <li>Total Proteins</li><hr>
            <li>S. Alkaline Phosphatase</li><hr>
            <li>S. Creatinine</li><hr>
            <li>Blood Urea</li><hr>
            <li>Serum Calcium + Phosphorus</li><hr>
            <li>Rheumatoid Factor</li><hr>
            <li>Post Prandial Blood Sugar</li><hr>
            <li>Stool Full Report/Occult Blood</li><hr>
            <li>E.C.G.</li><hr>
            <li>Chest X-Ray</li><hr>
            <li class="disc">Discussion of reports will be done by Consultant Physician & Dietician</li><hr>
            <li class="disc">PAP Smear (for Women), PSA (for Men) additional charges added</li><hr><br>
        </ul>
        <p class="price">Price Rs. 12,000/=</p>
    </div>
    </section>

    <!--Bottom-->
    <section class="bottom">
        <div class="bottom-container">
            <div class="bottom-content">
                <div class="bottom-hospital">
                    <h2>Care Compass Hospital (Pvt) Ltd</h2><br>
                    <p>Care Compass Hospital (Pvt) Ltd which initiated in 1993, committed to building a healthy nation
                        where everyone is capable to enjoy a healthy living.</p>
                </div>

                <div class="bottom-contact">
                    <h2>Contact us</h2><br>
                    <p>Care Compass Hospital (Pvt) Ltd<br>No. 62, W.A.Silva Mawatha, Wellawatta, Colombo - 06, Sri
                        Lanka.</p> <br>
                    <p>Hot Line: +94 011 4000 300</p><br>
                    <p>General: +94 112 586 581 | +94 112 584 212 | +94 112 597 56</p><br>
                    <p>E-mail: manager@carecompass.com</p>
                </div>

                <div class="bottom-social-media">
                    <h2>Stay Connected</h2><br>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Google+</a></li>
                        <li><a href="#">Pinterest</a></li>
                    </ul>
                </div>
            </div>
            <div class="bottom-nav">
                <div class="bottom-emergency">
                    <p>For emergency cases:☎ +94 011 4000 300</p>
                </div>
                <div class="bottom-copy">
                    <p>© 2025 - Care Compass Hospital - All Rights Reserved.<br>Concept, Design & Development by KODEX
                        Technologies</p>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>

</body>

</html>