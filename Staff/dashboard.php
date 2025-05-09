<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

// Fetch the total number of users
$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_users = $row['total_users'];

// Fetch the total number of departments
$sql_dept = "SELECT COUNT(*) as total_departments FROM departments";
$result_dept = $conn->query($sql_dept);
$row_dept = $result_dept->fetch_assoc();
$total_departments = $row_dept['total_departments'];

// Fetch the total number of doctors
$sql_doctors = "SELECT COUNT(*) as total_doctors FROM doctors";
$result_doctors = $conn->query($sql_doctors);
$row_doctors = $result_doctors->fetch_assoc();
$total_doctors = $row_doctors['total_doctors'];

// Fetch the total number of pending appointments
$sql_pending_appointments = "SELECT COUNT(*) as total_pending_appointments FROM appointments";
$result_pending_appointments = $conn->query($sql_pending_appointments);
$row_pending_appointments = $result_pending_appointments->fetch_assoc();
$total_pending_appointments = $row_pending_appointments['total_pending_appointments'];

// Fetch the total number of completed appointments
$sql_completed_appointments = "SELECT COUNT(*) as total_completed_appointments FROM completed_appointments";
$result_completed_appointments = $conn->query($sql_completed_appointments);
$row_completed_appointments = $result_completed_appointments->fetch_assoc();
$total_completed_appointments = $row_completed_appointments['total_completed_appointments'];

// Fetch the total number of pending reports
$sql_pending_reports_count = "SELECT COUNT(*) as total_pending_reports FROM test_requests";
$result_pending_reports_count = $conn->query($sql_pending_reports_count);
$row_pending_reports_count = $result_pending_reports_count->fetch_assoc();
$total_pending_reports = $row_pending_reports_count['total_pending_reports'];

// Fetch the total number of completed reports
$sql_completed_reports_count = "SELECT COUNT(*) as total_completed_reports FROM completed_report_request";
$result_completed_reports_count = $conn->query($sql_completed_reports_count);
$row_completed_reports_count = $result_completed_reports_count->fetch_assoc();
$total_completed_reports = $row_completed_reports_count['total_completed_reports'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
            <h1 class="tittle">Dashboard</h1>
            
            <div class="dashboard-cards">
                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_users; ?></h2>
                        <p>Total Users</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_departments; ?></h2>
                        <p>Total Departments</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_doctors; ?></h2>
                        <p>Total Doctors</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_pending_appointments; ?></h2>
                        <p>Pending Appointments</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_completed_appointments; ?></h2>
                        <p>Completed Appointments</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_pending_reports; ?></h2>
                        <p>Pending Reports</p>
                    </div>
                </div>

                <div class="count-card">
                    <div class="count">
                        <h2><?php echo $total_completed_reports; ?></h2>
                        <p>Completed Reports</p>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
