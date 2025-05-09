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
    <title>About Us | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="about.css">
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
            <h1>About Us</h1>
            <hr>
        </div>
    </section>

    <!--body section-->
    <section class="body-container">
        <div class="overlay"></div>
        <div class="body-content">
            <img src="Img/body forground.png" alt="Image">
            <div class="body-text">
                <h2>THRIVE WITH SEAMLESS QUALITY CARE: A CENTRE OF EXCELLENCE SERVICE</h2><br>
                <p>We’re not your typical healthcare provider; we’re here to give the care and coverage you need to
                    thrive.
                    We are operating since 1993 under the new management while adding enormous value to the Healthcare
                    service of Sri Lanka. Royal Hospital not only provides specialized medical services but also has a
                    staff
                    that understands its patients’ varied needs thus providing them and their families a personalized
                    service in a truly comfortable environment.</p><br>
                <p>We partner with Lanka Hospital Diagnostics services (LHD) so you have the accurate and reliable
                    information regarding your health issues through our laboratory reports. Having the 36-bed strength
                    and
                    performing more than 200 surgeries, we provide medical care to more than 3500 patients per month. We
                    also partner with communities to help them thrive and our excellence has been recognized and
                    reinforced
                    by the number of awards and accreditations.</p>
            </div>
        </div>
    </section>

    <!--Mission section-->
    <section class="mission-container">
        <div class="mission-image">
            <img src="Img/recepton.jpg" alt="Image">
        </div>
        <div class="mission-content">
            <div class="content">
                <h2>Mission</h2>
                <p>Our mission is to provide the best quality medical and nursing care to our valued patients meeting
                    the international stadards.</p>
            </div>

            <div class="content">
                <h2>Vision</h2>
                <p>Our vision is to be a leading healthcare provider in the country with superior nursing care and
                    medical attention.</p>
            </div>

            <div class="content">
                <h2>Objective</h2>
                <p>To promote the benefit of health care service without distiction of gender, race, color or political,
                    religious or other opinions or characteristics of individuals.</p>
            </div>
        </div>
    </section>

    <!--Core values section-->
    <section class="core-values">
        <div class="values-container">
            <div class="value-item">
                <img src="Img/Core-values/Accoutability.png" alt="Image">
                <h4>Accountability</h4>
                <p>We personally commit to delivering our best, taking responsibility for all of our decisions and
                    actions</p>
            </div>

            <div class="value-item">
                <img src="Img/Core-values/Quality.png" alt="Image">
                <h4>Quality</h4>
                <p>We improve effectiveness and efficiency of primary healthcare services while recognizing needs of our
                    patients</p>
            </div>

            <div class="value-item">
                <img src="Img/Core-values/Compassion.png" alt="Image">
                <h4>Compassion</h4>
                <p>We deliver patient-centered healthcare with compassion, dignity and respect for every patient and
                    their family</p>
            </div>

            <div class="value-item">
                <img src="Img/Core-values/Respect.png" alt="Image">
                <h4>Respect</h4>
                <p>We respect privacy of our patients hence we guarantee all privacy and confidentiality detail &
                    requirements</p>
            </div>

            <div class="value-item">
                <img src="Img/Core-values/Integrity.png" alt="Image">
                <h4>Integrity</h4>
                <p>We work as a team with full integrity while sharing institutional commitments to leadership, quality,
                    and value</p>
            </div>

            <div class="value-item">
                <img src="Img/Core-values/Safety.png" alt="Image">
                <h4>Safety</h4>
                <p>Demonstrate national leadership in providing high-value health care while safeguarding patients’ and
                    employees’ safety</p>
            </div>
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