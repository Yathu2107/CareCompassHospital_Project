<?php
include('connect.php'); // Include your database connection file

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

$user_id = $_GET['id'];

// Delete user
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    echo "<script>alert('User deleted successfully!'); window.location.href='user_management.php';</script>";
} else {
    echo "Error deleting user: " . $conn->error;
}
?>
