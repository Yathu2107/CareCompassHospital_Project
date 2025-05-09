<?php
include('connect.php'); // Include your database connection file

// Check if an ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

$user_id = $_GET['id'];

// Fetch user details
$sql = "SELECT id, firstName, lastName, email, mobileNumber FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];

    $update_sql = "UPDATE users SET firstName = ?, lastName = ?, email = ?, mobileNumber = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssis", $firstName, $lastName, $email, $mobileNumber, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href='user_management.php';</script>";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="user_management.css">
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
            <h1 class="tittle">Edit User</h1>
            <form method="POST" action="">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['firstName'] ?? ''); ?>"
                    required>

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" value="<?php echo htmlspecialchars($user['lastName'] ?? ''); ?>"
                    required>

                <label for="mobileNumber">Mobile Number:</label>
                <input type="tel" name="mobileNumber"
                    value="<?php echo htmlspecialchars($user['mobileNumber'] ?? ''); ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>

                <button type="submit">Update</button>
                <a href="user_management.php" class="cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>