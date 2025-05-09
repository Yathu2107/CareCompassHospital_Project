<?php
session_start();
include('connect.php');

// Check if 'id' is passed in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Doctor ID.");
}

$id = (int) $_GET['id'];

// Fetch the existing doctor details
$sql = "SELECT * FROM doctors WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die("Doctor not found.");
}
$doctor = mysqli_fetch_assoc($result);

// Fetch all departments for the dropdown
$sql_departments = "SELECT id, name FROM departments";
$result_departments = mysqli_query($conn, $sql_departments);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $doctorName = mysqli_real_escape_string($conn, $_POST['doctorName']);
    $departmentId = (int) $_POST['departmentId'];
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);

    $updateSql = "UPDATE doctors SET name = '$doctorName', 
                department_id = $departmentId, 
                branch = '$branch' WHERE id = $id";

    if (mysqli_query($conn, $updateSql)) {
        header("Location: doctors.php");
        exit();
    } else {
        echo "Error updating doctor: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="doctors.css">
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
                <li><a href="reports.php">Reports</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <h1 class="tittle">Edit Doctor</h1>

            <form method="POST" action="edit_doctor.php?id=<?php echo $id; ?>">
                <label for="doctorName">Doctor Name:</label>
                <input type="text" name="doctorName" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>

                <label for="departmentId">Department:</label>
                <select class="dep-select" name="departmentId" required>
                    <option value="">-- Select Department --</option>
                    <?php while ($dept = mysqli_fetch_assoc($result_departments)) {
                        $selected = ($dept['id'] == $doctor['department_id']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $dept['id']; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($dept['name']); ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="branch">Branch:</label>
                <select class="dep-select" name="branch" required>
                    <option value="">-- Select Branch --</option>
                    <option value="Colombo" <?php if ($doctor['branch'] == 'Colombo')
                        echo 'selected'; ?>>Colombo</option>
                    <option value="Kandy" <?php if ($doctor['branch'] == 'Kandy')
                        echo 'selected'; ?>>Kandy</option>
                    <option value="Kurunegala" <?php if ($doctor['branch'] == 'Kurunegala')
                        echo 'selected'; ?>>Kurunegala
                    </option>
                </select>

                <button class="update-btn" type="submit">Update</button>
                <a href="doctors.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>