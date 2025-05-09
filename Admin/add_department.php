<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    $query = "INSERT INTO departments (name) VALUES ('$name')";
    if (mysqli_query($conn, $query)) {
        header("Location: departments.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
