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

$id = (int)$_GET['id'];
$deleteQuery = "DELETE FROM doctor_availability WHERE id = $id";

if (mysqli_query($conn, $deleteQuery)) {
    header("Location: doctor_availability.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
