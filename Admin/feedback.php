<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}

include('connect.php');

// Fetch ratings and feedback from the report_feedback table
$feedbacks = [];
$sql = "SELECT * FROM report_feedback";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="feedback.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="user_management.php">User Management</a></li>
                <li><a href="staff_management.php">Staff Management</a></li>
                <li>
                    <a href="#">Doctor Management ▼</a>
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
                        <li><a href="pending_reports.php">Pending Reports</a></li>
                        <li><a href="completed_reports.php">Completed Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Payment Records ▼</a>
                    <ul class="dropdown">
                        <li><a href="consultation_payment.php">Consultations</a></li>
                        <li><a href="report_payments.php">Laboratory Reports</a></li>
                    </ul>
                </li>
                <li><a href="feedback.php">Ratings & Feedbacks</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h1 class="tittle">Ratings & Feedbacks</h1>

            <!-- Display the feedback data -->
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <tr>
                            <td><?php echo $feedback['report_id']; ?></td>
                            <td><?php echo $feedback['rating']; ?></td>
                            <td><?php echo $feedback['feedback']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
