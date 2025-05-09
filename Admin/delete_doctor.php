<?php
session_start();
include('connect.php');

// Check if 'id' is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Doctor ID.");
}

$id = (int) $_GET['id'];

// Perform the delete
$sql = "DELETE FROM doctors WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header("Location: doctors.php");
    exit();
} else {
    echo "Error deleting doctor: " . mysqli_error($conn);
}
?>
