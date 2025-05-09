<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}

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
    <title>Admin Portal | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="doctor_availability.css">
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
            <h1 class="tittle">Doctor Availability</h1>

            <!-- ADD NEW DOCTOR BUTTON -->
            <button class="add-btn" onclick="openForm()">Add New Availability</button>

            <!-- OVERLAY AND POPUP FORM -->
            <div id="overlay" class="overlay" onclick="closeForm()"></div>
            <div id="availabilityForm" class="form-popup">
                <form action="add_availability.php" method="POST" class="form-container">
                    <h2>Add Doctor Availability</h2>

                    <label for="doctor_id">Doctor:</label>
                    <select name="doctor_id" required>
                        <option value="">-- Select Doctor --</option>
                        <?php
                        $doctorQuery = "SELECT d.id, d.name, dep.name AS department FROM doctors d 
                        JOIN departments dep ON d.department_id = dep.id";
                        $doctorResult = mysqli_query($conn, $doctorQuery);
                        while ($doctor = mysqli_fetch_assoc($doctorResult)) {
                            echo "<option value='{$doctor['id']}'>" . htmlspecialchars($doctor['name']) .
                                " ({$doctor['department']})</option>";
                        }
                        ?>
                    </select>

                    <label for="day">Available Day:</label>
                    <select name="day" required>
                        <option value="">-- Select Day --</option>
                        <?php
                        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                        foreach ($days as $day) {
                            echo "<option value='$day'>$day</option>";
                        }
                        ?>
                    </select>

                    <label for="time">Available Time:</label>
                    <input type="text" name="time" required>

                    <button type="submit">Add Availability</button>
                    <button type="button" class="cancel-btn" onclick="closeForm()">Cancel</button>
                </form>
            </div>

            <!--Table for Doctor Availability-->
            <table class="doctor-availability">
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Available Day</th>
                        <th>Available Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['doctor_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['department'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['available_day'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['available_time'] ?? '') ?></td>
                            <td>
                                <a href="edit_availability.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                                <a href="delete_availability.php?id=<?= $row['id'] ?>" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this record?');">
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

    <script>
        function openForm() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById("availabilityForm").style.display = "block";
        }
        function closeForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById("availabilityForm").style.display = "none";
        }

    </script>
</body>

</html>