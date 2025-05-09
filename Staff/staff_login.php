<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connect.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_email = trim(strtolower($_POST['email'])); // Trim spaces and convert to lowercase
    $staff_password = $_POST['password'];

    // Debug: Check input values
    echo "Email: " . htmlspecialchars($staff_email) . "<br>";
    echo "Password: " . htmlspecialchars($staff_password) . "<br>";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM staff_users WHERE LOWER(email) = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $staff_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Debug: Check fetched user details
        echo "User Found: " . htmlspecialchars($user['email']) . "<br>";
        echo "Password from DB: " . htmlspecialchars($user['password']) . "<br>";
        echo "Entered Password: " . htmlspecialchars($staff_password) . "<br>";

        if ($staff_password == $user['password']) { // Compare plain text passwords
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect username or Password!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Incorrect username or Password!'); window.location.href='index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>