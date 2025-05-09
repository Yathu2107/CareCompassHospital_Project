<?php
session_start();
include('connect.php');

// Fetch department details if the form is not submitted
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM departments WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $department = mysqli_fetch_assoc($result);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Prepare update query
    $query = "UPDATE departments SET name = '$name' WHERE id = $id";

    // Execute query
    if (mysqli_query($conn, $query)) {
        header("Location: departments.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="departments.css">
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
            <h1 class="tittle">Edit Department</h1>
            <form method="POST" action="edit_department.php?id=<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="name">Department Name :</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($department['name']); ?>" required>

                <button class="ed-btn" type="submit">Update</button>
                <a href="departments.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>