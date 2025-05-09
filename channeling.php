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
    <title>Channeling | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="channeling.css">
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
                    <li><a href="appointment.php" onclick="checkLogin('appointment.php')"> Schedule an Appointment</a>
                    </li>
                    <li><a href="manageAppointment.php" onclick="checkLogin('manageAppointment.php')">Manage
                            Appointment</a></li>
                    <li><a href="payment.php" onclick="checkLogin('payment.php')">Payment History</a></li>
                </ul>
            </li>
            <li><a href="contact.php">CONTACT US</a></li>
        </ul>
    </section>

    <!--Heading section-->
    <section class="heading-section">
        <div class="heading-content">
            <h1>Channeling</h1>
            <hr>
        </div>
    </section>

    <!--Promotional Advertisement-->
    <section class="promo-ad">
        <div class="promo-content">
            <div class="promo-image">
                <img src="Img/channelling.jpg" alt="Image">
            </div>
            <div class="promo-text">
                <h2>Channel your Doctor today @ Care Compass Hospital</h2>
                <p>Care Compass Hospital's mission is to inspire and empower you and our community to engage in the
                    pursuit of health and well-being for life. At Care Compass Hospital, you can be assured that our
                    expert team is committed to providing you with exceptional care. We have locally and globally
                    renowned consultants with years of medical practice to treat all sorts of ailments. Our physicians
                    work together to drive positive change in the communities we serve, helping patients to live
                    happier, healthier lives.</p>
            </div>
        </div>
    </section>

    <!-- Department Selection -->
    <section class="department-selection">
        <h2>Select Department</h2>
        <div class="departments">
            <button class="department-btn" onclick="showTimetable('Cardiology')">Cardiology</button>
            <button class="department-btn" onclick="showTimetable('Ent Surgeon')">Ent Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Gynaecologist')">Gynaecologist</button>
            <button class="department-btn" onclick="showTimetable('Oncological Surgeon')">Oncological Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Peadiatric Surgeon')">Peadiatric Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Rheumatalogist')">Rheumatalogist</button>
            <button class="department-btn" onclick="showTimetable('Urologist')">Urologist</button>
            <button class="department-btn" onclick="showTimetable('Chest Physcian')">Chest Physcian</button>
            <button class="department-btn" onclick="showTimetable('Diabetic specialist')">Diabetic specialist</button>
            <button class="department-btn" onclick="showTimetable('Eye Surgeon')">Eye Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Nephrologist')">Nephrologist</button>
            <button class="department-btn" onclick="showTimetable('Oncologist')">Oncologist</button>
            <button class="department-btn" onclick="showTimetable('Peadiatrician')">Peadiatrician</button>
            <button class="department-btn" onclick="showTimetable('Sports Medicine')">Sports Medicine</button>
            <button class="department-btn" onclick="showTimetable('Vaccinologist')">Vaccinologist</button>
            <button class="department-btn" onclick="showTimetable('Dental Surgeon')">Dental Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Diabetologist')">Diabetologist</button>
            <button class="department-btn" onclick="showTimetable('General Physician')">General Physician</button>
            <button class="department-btn" onclick="showTimetable('Orthopaedic Surgeon')">Orthopaedic Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Phsyciatric Councelling')">Phsyciatric
                Councelling</button>
            <button class="department-btn" onclick="showTimetable('Thoracic Surgeon')">Thoracic Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Vascular & Transplant Surgeon')">Vascular &
                Transplant Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Dermatologist')">Dermatologist</button>
            <button class="department-btn" onclick="showTimetable('Dieticions & Nutrician')">Dieticions &
                Nutrician</button>
            <button class="department-btn" onclick="showTimetable('General Surgeon')">General Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Neuro Surgeon')">Neuro Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Peadiatric Neonatalogist')">Peadiatric
                Neonatalogist</button>
            <button class="department-btn" onclick="showTimetable('Psychiatrists')">Psychiatrists</button>
            <button class="department-btn" onclick="showTimetable('Urologist - Kidney Transplant Surgeon')">Urologist -
                Kidney Transplant Surgeon</button>
            <button class="department-btn" onclick="showTimetable('Venereologist')">Venereologist</button>
        </div>
    </section>

    <!-- Timetable Display -->
    <section class="timetable" id="timetable">
        <h2>Doctor Timetable</h2>
        <div id="timetable-content">
            <!-- Timetable content will be displayed here -->
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
    <script src="channeling.js"></script>
    
</body>

</html>