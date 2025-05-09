<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch doctor availability
$query = "SELECT da.id, d.name AS doctor_name, dep.name AS department, da.available_day, da.available_time 
          FROM doctor_availability da
          JOIN doctors d ON da.doctor_id = d.id
          JOIN departments dep ON d.department_id = dep.id
          LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Count total records for pagination
$count_query = "SELECT COUNT(*) AS total FROM doctor_availability";
$count_result = mysqli_query($conn, $count_query);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Availability | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="doctor_availability.css">
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
            <h1 class="tittle">Doctor Availability</h1>

            <!--Table for Doctor Availability-->
            <table class="doctor-availability">
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Available Day</th>
                        <th>Available Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                            <td><?= htmlspecialchars($row['department']) ?></td>
                            <td><?= htmlspecialchars($row['available_day']) ?></td>
                            <td><?= htmlspecialchars($row['available_time']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- PAGINATION LINKS -->
            <div class="pagination">
                <?php if ($page > 1) { ?>
                    <a href="doctor_availability.php?page=<?php echo $page - 1; ?>">Previous</a>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a href="doctor_availability.php?page=<?php echo $i; ?>"
                        class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } ?>

                <?php if ($page < $total_pages) { ?>
                    <a href="doctor_availability.php?page=<?php echo $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
            
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
