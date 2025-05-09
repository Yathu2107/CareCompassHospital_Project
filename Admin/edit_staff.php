<?php
session_start();
include('connect.php');

// Fetch staff details if the form is not submitted
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM staff_users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];

    // If password is provided
    $password = isset($_POST['password']) && $_POST['password'] ? $_POST['password'] : null;

    // Prepare update query
    $query = "UPDATE staff_users SET firstName = '$firstName', lastName = '$lastName', dateOfBirth = '$dateOfBirth', email = '$email', gender = '$gender'";

    if ($password) {
        $query .= ", password = '$password'";
    }

    $query .= " WHERE id = $id";

    // Execute query
    if (mysqli_query($conn, $query)) {
        header("Location: staff_management.php");
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
    <title>Edit Staff | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="staff_management.css">
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
            <h1 class="tittle">Edit Staff</h1>
            <form method="POST" action="edit_staff.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" value="<?php echo htmlspecialchars($row['firstName']); ?>" required>

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" value="<?php echo htmlspecialchars($row['lastName']); ?>" required>

                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" name="dateOfBirth" value="<?php echo htmlspecialchars($row['dateOfBirth']); ?>"
                    required>

                <label for="gender">Gender:</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male' ? 'checked' : ''); ?> required> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female' ? 'checked' : ''); ?>> Female</label>
                    <label><input type="radio" name="gender" value="Other" <?php echo ($row['gender'] == 'Other' ? 'checked' : ''); ?>> Other</label>
                </div>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

                <label for="password">Password (leave blank to keep the same):</label>
                <input type="password" name="password">

                <button class="update-btn" type="submit">Update</button>
                <a href="staff_management.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>