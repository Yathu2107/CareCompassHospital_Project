<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}
include('connect.php');

// Fetch completed reports from completed_report_request table
$completed_reports = [];
$sql = "SELECT * FROM completed_report_request";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $completed_reports[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Completed Repotrs | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="completed_reports.css">
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
            <h1 class="tittle">Completed Reports</h1>

            <!-- Display completed reports -->
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Name</th>
                        <th>Report Name</th>
                        <th>File</th>
                        <th>Upload Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completed_reports as $report): ?>
                        <tr>
                            <td><?php echo $report['id']; ?></td>
                            <td><?php echo $report['name']; ?></td>
                            <td><?php echo $report['report_name']; ?></td>
                            <td><a href="<?php echo $report['file_path']; ?>" target="_blank">View Report</a></td>
                            <td><?php echo $report['upload_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>

</html>