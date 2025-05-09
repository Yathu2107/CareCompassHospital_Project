<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

//Pagination Setup
$records_per_page = 10;// Number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch Doctors (with JOIN to get Department Name)
$sql = "SELECT d.id, d.name AS doctor_name, dp.name AS department_name, d.branch 
        FROM doctors d
        JOIN departments dp ON d.department_id = dp.id
        LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);

//Tetch total number of Doctors (for pagination calculation)
$sql_count = "SELECT COUNT(*) AS total_doctors FROM doctors";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_doctors = $row_count['total_doctors'];
$total_pages = ceil($total_doctors / $records_per_page);

//Fetch Departments (for the 'Add New Doctor' dropdown)
$sql_departments = "SELECT id, name FROM departments";
$result_departments = mysqli_query($conn, $sql_departments);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="doctors.css">
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
            <h1 class="tittle">Doctors</h1>

            <!-- TABLE FOR DOCTORS -->
            <table class="doctor-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($doctor = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <td><?php echo $doctor['id'] ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($doctor['doctor_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($doctor['department_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($doctor['branch'] ?? ''); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- PAGINATION LINKS -->
            <div class="pagination">
                <?php if ($page > 1) { ?>
                    <a href="doctors.php?page=<?php echo $page - 1; ?>">Previous</a>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a href="doctors.php?page=<?php echo $i; ?>" 
                       class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                       <?php echo $i; ?>
                    </a>
                <?php } ?>

                <?php if ($page < $total_pages) { ?>
                    <a href="doctors.php?page=<?php echo $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
            
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
