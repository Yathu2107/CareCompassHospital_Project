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

<?php
// Fetch departments from the database
$departments = [];
$sql = "SELECT * FROM departments";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

// Fetch doctors from the database
$doctors = [];
$sql = "SELECT * FROM doctors";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $doctors[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule an Appointment | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="appointment.css">
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
            <h1>Schedule an Appointment</h1>
            <hr>
        </div>
    </section>

    <!-- Appointment Booking Section -->
    <section class="appointment-section">
        <div class="appointment-container">
            <h2>Book an Appointment</h2>
            <form id="appointmentForm" action="save_appointment.php" method="post">
                <label for="name">Name :</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Age :</label>
                <input type="number" id="age" name="age" required>

                <label for="gender">Gender :</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female" required> Female</label>
                    <label><input type="radio" name="gender" value="Other" required> Other</label>
                </div>

                <label for="mobile">Mobile Number :</label>
                <input type="text" id="mobile" name="mobile" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email"
                    value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly required>

                <label for="department">Select Department :</label>
                <select id="department" name="department" onchange="updateDoctors()" required>
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="branch">Select Branch :</label>
                <select id="branch" name="branch" onchange="updateDoctors()" required>
                    <option value="">Select Branch</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kurunegala">Kurunegala</option>
                </select>

                <label for="doctor">Select Doctor :</label>
                <select id="doctor" name="doctor" onchange="updateDates()" required>
                    <option value="">Select Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['id']; ?>"
                            data-department="<?php echo $doctor['department_id']; ?>"
                            data-branch="<?php echo $doctor['branch']; ?>">
                            <?php echo $doctor['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="appointment_date">Select Date :</label>
                <input type="date" id="appointment_date" name="appointment_date" required>

                <label for="appointment_time">Select Time :</label>
                <select id="appointment_time" name="appointment_time" required>
                    <option value="">Select Time</option>
                </select>

                <button type="submit">Book Appointment</button>
            </form>
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

    <script>
        // If the user is not logged in, redirect to index.php
        if (!localStorage.getItem('isLoggedIn')) {
            window.location.href = 'index.php'; // Redirect to index.php
        }
    </script>

    <script src="script.js"></script>
    <script src="appointment.js"></script>

</body>

</html>