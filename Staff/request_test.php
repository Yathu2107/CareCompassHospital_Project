<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}
include('connect.php');

// Function to fetch user details by mobile number
function getUserDetailsByMobile($conn, $mobileNumber)
{
    $sql = "SELECT lastName, email FROM users WHERE mobileNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mobileNumber);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobileNumber = $_POST['mobileNumber'];
    $reportName = $_POST['reportName'];

    // Fetch user details
    $userDetails = getUserDetailsByMobile($conn, $mobileNumber);
    if (!$userDetails) {
        die("User not found.");
    }

    $name = $userDetails['lastName'];
    $email = $userDetails['email'];

    // Store form details in test_requests table
    $insertQuery = "INSERT INTO test_requests (name, mobile_number, email, report_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $name, $mobileNumber, $email, $reportName);

    if ($stmt->execute()) {
        $requestId = $stmt->insert_id; // Get the inserted request ID
        $_SESSION['request_id'] = $requestId; // Store request ID in session
        header("Location: test_bill_form.php?request_id=".$requestId);
        exit();
    } else {
        die("Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Request for Test | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="request_test.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script>
        function fetchUserDetails() {
            var mobileNumber = document.getElementById("mobileNumber").value;
            if (mobileNumber.length > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "fetch_user_details.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var user = JSON.parse(xhr.responseText);
                        if (user) {
                            document.getElementById("name").value = user.lastName;
                            document.getElementById("email").value = user.email;
                        } else {
                            alert("User not found.");
                        }
                    }
                };
                xhr.send("mobileNumber=" + mobileNumber);
            }
        }
    </script>
</head>

<body>
    <div class="staff-container">
        <nav class="sidebar">
            <h2>Staff Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="user_List.php">User List</a></li>
                <li>
                    <a href="#">Doctor List ▼</a>
                    <ul class="dropdown">
                        <li><a href="departments.php">Departments</a></li>
                        <li><a href="doctors.php">Doctors</a></li>
                        <li><a href="doctor_availability.php">Doctor Availability</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Appointments ▼</a>
                    <ul class="dropdown">
                        <li><a href="pending_appointments.php">Pending Appointments</a></li>
                        <li><a href="completed_appointments.php">Completed Appointments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Laboratory Tests ▼</a>
                    <ul class="dropdown">
                        <li><a href="request_test.php">Request for Test</a></li>
                        <li><a href="pending_reports.php">Pending Reports</a></li>
                        <li><a href="completed_reports.php">Completed Reports</a></li>
                    </ul>
                </li>
                <li><a href="feedback.php">Ratings & Feedback</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h1 class="tittle">Request for Test</h1>

            <form class="request-form" method="POST" action="">
                <div class="form-group-inline">
                    <input type="tel" id="mobileNumber" name="mobileNumber" placeholder="Mobile Number" required>
                    <button type="button" onclick="fetchUserDetails()">Find</button>
                </div>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" readonly required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" readonly required>

                <label for="reportName">Select Report:</label>
                <select id="reportName" name="reportName" required>
                    <option value="blood chemistry reports">Blood Chemistry Reports</option>
                    <option value="hematology reports">Hematology Reports</option>
                    <option value="microbiology reports">Microbiology Reports</option>
                    <option value="urinalysis reports">Urinalysis Reports</option>
                    <option value="pathology reports">Pathology Reports</option>
                    <option value="toxicology reports">Toxicology Reports</option>
                    <option value="serology reports">Serology Reports</option>
                </select>

                <button type="submit">Submit & Pay</button>
            </form>
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>

</html>