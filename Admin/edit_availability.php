<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Availability ID.");
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM doctor_availability WHERE id = $id";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) === 0) {
    die("Availability not found.");
}
$availability = mysqli_fetch_assoc($result);

$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time = $_POST['time'];
    
    $updateQuery = "UPDATE doctor_availability SET available_day = '$day', available_time = '$time' WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: doctor_availability.php");
        exit();
    } else {
        echo "Error updating availability: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Doctor Availability | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="doctor_availability.css">
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
                <li><a href="reports.php">Reports</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <h1 class="tittle">Edit Doctor Availability</h1>
            <form action="edit_availability.php?id=<?= $id ?>" method="POST">
                <label for="day">Available Day:</label>
                <select class="day-select" name="day" required>
                    <?php
                    foreach ($daysOfWeek as $dayOfWeek) {
                        // Check if this day is already set in the database
                        $selected = ($availability['available_day'] == $dayOfWeek) ? 'selected' : '';
                        echo "<option value='$dayOfWeek' $selected>$dayOfWeek</option>";
                    }
                    ?>
                </select>

                <label for="time">Available Time:</label>
                <input type="text" name="time" value="<?= htmlspecialchars($availability['available_time']) ?>"
                    required>

                <button class="update-btn" type="submit">Update</button>
                <a href="doctor_availability.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>

</body>

</html>