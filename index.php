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
    <title>Home | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="style.css">
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
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number" required>
                    <label for="mobileNumber">Mobile Number</label>
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

    <!--Image Slider-->
    <section class="carousel-container">
        <div class="carousel">
            <div class="slide active">
                <img src="Img/slide1.jpg" alt="Image 1">
                <div class="text-overlay">
                    <p>CARE COMPASS HOSPITAL , <br> A NAME THAT REDESIGNS <br> THE DELEVERY <br> OF SPECIALTY CARE</p>
                </div>
            </div>

            <div class="slide">
                <img src="Img/slide2.jpg" alt="Image 2">
                <div class="text-overlay">
                    <p>MEET ALL YOUR <br> MEDICAL NEEEDS UNDER <br> ONE ROOF, WE ARE HERE <br> TO TAKE CARE OF YOU</p>
                </div>
            </div>

            <div class="slide">
                <img src="Img/slide3.jpg" alt="Image 3">
                <div class="text-overlay">
                    <p>AN INTEGRATED HEALTHCARE <br> WORKFORCE WITH <br> INNOVATIVE TOOLS, <br> RESOURCE AND TECHNOLOGY
                    </p>
                </div>
            </div>

            <div class="slide">
                <img src="Img/slide4.jpg" alt="Image 4">
                <div class="text-overlay">
                    <p>WE ARE ENSURING <br> A HEALTHIER FUTURE <br> WITH AN EXCELLENT CARE</p>
                </div>
            </div>
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>
    </section>

    <!--Menu-->
    <section class="menu-container">
        <div class="menu-content">
            <div class="column">
                <h3>Working Time</h3><br>
                <p>Hotline: +011 4000 300</p>
                <p>Fax: 9.30 – 17.30</p>
                <p>Open Hours: 24/7 Open OPD</p><br><br>
                <a href="about.php" class="menu-btn">Learn more →</a>
            </div>

            <div class="column">
                <h3>Doctors Timetable</h3><br>
                <p>Book your doctor today with us. All residential and visiting medical specialists are listed for you
                    to know the available time and dates. </p><br><br>
                <a href="channeling.php" class="menu-btn">View Timetable →</a>
            </div>

            <div class="column">
                <h3>Health Packages</h3><br>
                <p>Health is wealth. We offer a wide range of health packages for affordable prices for you to test your
                    health conditions.</p><br><br>
                <a href="health.php" class="menu-btn">View Health Packages →</a>
            </div>

            <div class="column">
                <h3>Our Hotline</h3><br>
                <p>+94 011 4000 300</p>
                <p>Contact us for any sort of inquiries or for more information. We are always here to help you...</p>
                <br><br>
                <a href="contact.php" class="menu-btn">Contact Us →</a>
            </div>
        </div>
    </section>


    <!--About us section-->
    <section class="about-section">
        <div class="about-image">
            <img src="Img/Hospital Building.avif" alt="Hospital building">
        </div>

        <div class="about-content">
            <h3>Welcome to Care Compass Hospital</h3><br>
            <p>All we care about is your health and well-being. At Care Compass Hospital, we treat all our patients with
                full care, assisting all their needs while ensuring their health and fitness. Here, patients have access
                to all medical and surgical sub-specialties within a single institution, empowering the medical team to
                address all the patient's health needs and treat the whole person.</p>
            <p>We are committed to providing quality health care for all. Our goal is to inspire and empower you and our
                community to engage in the pursuit of health and well-being for life. Our expert team and leading
                medical practitioners are dedicated to providing their service every day for you.</p><br>
            <p><strong>"Get to know what we are best at"</strong></p>
            <a href="about.php" class="about-btn">MORE ABOUT US →</a>
        </div>
    </section>


    <!--Banner-->
    <section class="banner">
        <div class="banner-overlay">
            <h2>The best doctors in the world are at your fingertips.Visit our channeling page today to channel the
                best doctor for you.</h2>
            <a href="channeling.php" class="banner-btn">VISIT NOW →</a>
        </div>
    </section>

    <!--Department section-->
    <section class="department-section">
        <h2>Our Departments</h2>
        <hr>
        <div class="department-container">
            <div class="department">
                <img src="Img/Department/Pulmunory.png" alt="image">
                <h3>Pulmonary Unit</h3>
                <p>Provide outstanding medical services to the patients with respiratory disease and critical illness
                </p>
            </div>

            <div class="department">
                <img src="Img/Department/Neurology Unit.png" alt="image">
                <h3>Neurology Unit</h3>
                <p>Deal with the disorders related to the nervous system and give treatments</p>
            </div>

            <div class="department">
                <img src="Img/Department/Dermatology.png" alt="image">
                <h3>Dermatology</h3>
                <p>Concerned with the diagnosis and treatment of diseases of the skin, hair and nails</p>
            </div>

            <div class="department">
                <img src="Img/Department/Nephrology.png" alt="image">
                <h3>Nephrology</h3>
                <p>Deal with the problems and ailments related to your kidneys</p>
            </div>

            <div class="department">
                <img src="Img/Department/Orthopaedic unit.png" alt="image">
                <h3>Orthopaedic Unit</h3>
                <p>Focuses on injuries and diseases of your body’s musculoskeletal system</p>
            </div>

            <div class="department">
                <img src="Img/Department/Cardiology.png" alt="image">
                <h3>Cardiology</h3>
                <p>Deal with disorders of the heart as well as parts of the circulatory system</p>
            </div>

            <div class="department">
                <img src="Img/Department/Psychotherapy.png" alt="image">
                <h3>Psychotherapy</h3>
                <p>We assist you in solving problems that affect your mind so badly</p>
            </div>

            <div class="department">
                <img src="Img/Department/Endocrinology.png" alt="image">
                <h3>Endocrinology</h3>
                <p>Deal with the endocrine system, its diseases, and hormone-related problems</p>
            </div>

            <div class="department">
                <img src="Img/Department/Sports Medicine.png" alt="image">
                <h3>Sports Medicine</h3>
                <p>Deals with physical fitness and the treatment and prevention of injuries related to sports and
                    exercise</p>
            </div>

            <div class="department">
                <img src="Img/Department/General Physician.png" alt="image">
                <h3>General Physician</h3>
                <p>We provide a range of non-surgical healthcare treatments to our patients</p>
            </div>

            <div class="department">
                <img src="Img/Department/Rheumatology.png" alt="image">
                <h3>Rheumatology</h3>
                <p>Provide a full clinical service to the matters related to your joints</p>
            </div>

            <div class="department">
                <img src="Img/Department/Eye Unit.png" alt="image">
                <h3>Eye Unit</h3>
                <p>Provide all eye care treatments at one place</p>
            </div>

            <div class="department">
                <img src="Img/Department/Oncology.png" alt="image">
                <h3>Oncology</h3>
                <p>We are specialized in providing treatments related to cancers</p>
            </div>

            <div class="department">
                <img src="Img/Department/Counselling.png" alt="image">
                <h3>Counselling</h3>
                <p>Provide a supportive, respectful and confidential environment to discuss matters concerning you</p>
            </div>

            <div class="department">
                <img src="Img/Department/Urology.png" alt="image">
                <h3>Urology</h3>
                <p>Focuses on diseases of the urinary tract and the male reproductive tract</p>
            </div>

            <div class="department">
                <img src="Img/Department/ENT Unit.png" alt="image">
                <h3>ENT Unit</h3>
                <p>We provide treatments for all your conditions related to the ear, nose, and throat</p>
            </div>

            <div class="department">
                <img src="Img/Department/Paediatric.png" alt="image">
                <h3>Paediatric</h3>
                <p>Deal with all the medical issues related to infants, children, and adolescents</p>
            </div>

            <div class="department">
                <img src="Img/Department/Diabetology.png" alt="image">
                <h3>Diabetology</h3>
                <p>Solve the problems related to abnormally high-level sugar (glucose) in the blood.</p>
            </div>

            <div class="department">
                <img src="Img/Department/Vaccinology and medical virology.png" alt="image">
                <h3>Vaccinology and medical virology</h3>
                <p>Provide necessary vaccine treatments and focuses on all sorts of viral infections</p>
            </div>

            <div class="department">
                <img src="Img/Department/Vascular and Transplant.png" alt="image">
                <h3>Vascular and Transplant</h3>
                <p>Concerned with the problems related to the vascular system and organ transplantation</p>
            </div>

            <div class="department">
                <img src="Img/Department/General Surgeries.png" alt="image">
                <h3>General Surgeries</h3>
                <p>We specially focus on surgeries related to abdominal contents</p>
            </div>

        </div>
    </section>

    <!--Why choose us-->
    <section class="choose-us">
        <div class="choose-us-image">
            <img src="Img/Medical team.webp" alt="Medical team">
        </div>
        <div class="heading">
            <h2>WHY CHOOSE US?</h2>
            <hr>
            <div class="body">
                <div>
                    <h3>Quality is our motto</h3>
                    <p>We are committed to providing a quality service to our patients. Our expertise team which
                        consists of
                        more than 130 employees and a globally recognized panel of doctors dedicated to providing a
                        quality
                        service.</p>

                    <div>
                        <h3>Leaders in prevention</h3>
                        <p>A philosophy of preventive care and overall wellness. So we provide routine appointments,
                            preventive
                            screenings, wellness programs, and more to help prevent you from getting sick in the first
                            place.
                        </p>
                    </div>

                    <div>
                        <h3>Cutting-edge technology</h3>
                        <p>We employ the most advanced technological equipment in diagnosing process without being
                            clueless
                            in
                            finding a solution for your health issues. Our lab is managed under Lanka Hospital
                            Diagnostics
                            (LHD)
                            to offer reliable service.</p>
                    </div>

                    <div>
                        <h3>The best facilities ever</h3>
                        <p>Care Compass hospital has bed strength of 36 beds, and with one operating theatre we perform
                            more
                            than 200
                            surgeries, provide medical care to more than 3500 outpatients and treat more than 175 inward
                            patients per month. 24h open OPD is available for you with a qualified doctor standby.</p>
                    </div>
                </div>
            </div>
    </section>

    <!--hospital section-->
    <section class="hospital-section">
        <div class="hospital-card">
            <img src="Img/nurse with patient.avif" alt="Hospital Image 1">
            <div class="hospital-content">
                <h3>Care Compass Hospital - Superb care under one roof</h3>
                <p>Our history began in 1993 in Wellawatta as a private limited liability hospital with the name Sri
                    Lanka Nursing Home and functioned for last fifty years with the previous management. With the
                    present management, the hospital is renamed as Royal hospital and today our medical experts
                    offer more than 200 surgeries, provide medical care to more than 3500 outpatients, and treat
                    more than 175 inward patients per month.</p>
            </div>
        </div>
        <div class="hospital-card">
            <img src="Img/hospital corridor.jpg" alt="Hospital Image 2">
            <div class="hospital-content">
                <h3>Care Compass Co-op Hospital - We care about your wellbeing</h3>
                <p>Care Compass Co-op Hospital which initiated as a subsidiary of Care Compass Hospital in 2018 in
                    Kotahena, we
                    offer a quality service with our expert team of employees and world-renowned panel of doctors at
                    affordable prices to provide you with a better service while entrusting a nation with healthy
                    people. We bring the convenience of having many of your medical needs met under one roof, so
                    your experience allows you to thrive with seamless, quality care.</p>
            </div>
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