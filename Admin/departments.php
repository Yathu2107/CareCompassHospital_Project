<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}

include('connect.php');

// Set the number of records per page
$records_per_page = 10;

// Get the current page number, if not set, default to page 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch departments based on the current page
$sql = "SELECT * FROM departments LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Fetch total records count to calculate total pages
$sql_total = "SELECT COUNT(*) AS total FROM departments";
$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Management | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="departments.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="user_management.php">User Management</a></li>
                <li><a href="staff_management.php">Staff Management</a></li>
                <li><a href="#">Doctor Management ▼</a>
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
            <h1 class="tittle">Departments</h1>
            <button class="add-btn" onclick="openForm()">Add New Department</button>

            <!-- Popup Form -->
            <div id="overlay" class="overlay"></div>
            <div id="departmentForm" class="form-popup">
                <form action="add_department.php" method="POST" class="form-container">
                    <h2>Add Department</h2>

                    <label for="name">Department Name:</label>
                    <input type="text" name="name" required>

                    <button type="submit" class="submit-btn">Add</button>
                    <button type="button" class="cancel-btn" onclick="closeForm()">Cancel</button>
                </form>
            </div>

            <!-- Department Table -->
            <table class="department-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Department Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                                <a href="edit_department.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                <a href="delete_department.php?id=<?php echo $row['id']; ?>" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="departments.php?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="departments.php?page=<?php echo $i; ?>"
                        class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="departments.php?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>

    <script>
        function openForm() {
            document.getElementById("departmentForm").style.display = "block";
            document.getElementById("overlay").style.display = "block"; // Show the overlay
        }

        function closeForm() {
            document.getElementById("departmentForm").style.display = "none";
            document.getElementById("overlay").style.display = "none"; // Hide the overlay
        }
    </script>
</body>

</html>