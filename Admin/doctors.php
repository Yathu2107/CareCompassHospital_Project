<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
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
    <title>Doctor Management | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="doctors.css">
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

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="tittle">Doctors</h1>

            <!-- ADD NEW DOCTOR BUTTON -->
            <button class="add-btn" onclick="openForm()">Add New Doctor</button>

            <!-- OVERLAY AND POPUP FORM -->
            <div id="overlay" class="overlay" onclick="closeForm()"></div>
            <div id="doctorForm" class="form-popup">
                <form action="add_doctor.php" method="POST" class="form-container">
                    <h2>Add Doctor</h2>

                    <label for="doctorName">Doctor Name:</label>
                    <input type="text" name="doctorName" required>

                    <label for="departmentId">Department:</label>
                    <select name="departmentId" required>
                        <option value="">-- Select Department --</option>
                        <?php while ($dept = mysqli_fetch_assoc($result_departments)) { ?>
                            <option value="<?php echo $dept['id']; ?>">
                                <?php echo htmlspecialchars($dept['name']); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="branch">Branch:</label>
                    <select name="branch" required>
                        <option value="">-- Select Branch --</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kurunegala">Kurunegala</option>
                    </select>

                    <button type="submit">Add</button>
                    <button type="button" class="cancel-btn" onclick="closeForm()">Cancel</button>
                </form>
            </div>

            <!-- TABLE FOR DOCTORS -->
            <table class="doctor-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($doctor = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $doctor['id'] ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($doctor['doctor_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($doctor['department_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($doctor['branch'] ?? ''); ?></td>
                            <td>
                                <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="edit-btn">Edit</a>
                                <a href="delete_doctor.php?id=<?php echo $doctor['id']; ?>" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this doctor?');">
                                    Delete
                                </a>
                            </td>
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
                    <a href="doctors.php?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>">
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

    <script>
        function openForm() {
            document.getElementById("overlay").style.display = "block";
            document.getElementById("doctorForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("overlay").style.display = "none";
            document.getElementById("doctorForm").style.display = "none";
        }
    </script>
</body>

</html>