<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}
include('connect.php');

// Fetch completed reports
$sql_completed_reports = "SELECT * FROM completed_report_request";
$result_completed_reports = $conn->query($sql_completed_reports);
$completed_reports = [];
while ($row_completed = $result_completed_reports->fetch_assoc()) {
    $completed_reports[] = $row_completed;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Completed Reports | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="completed_reports.css">
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
            <h1 class="tittle">Completed Reports</h1>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Report Name</th>
                        <th>File Path</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completed_reports as $report): ?>
                        <tr>
                            <td><?php echo $report['request_id']; ?></td>
                            <td><?php echo $report['name']; ?></td>
                            <td><?php echo $report['email']; ?></td>
                            <td><?php echo $report['report_name']; ?></td>
                            <td><a href="../Staff/<?php echo $report['file_path']; ?>" target="_blank">Download Report</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>