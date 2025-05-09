<?php
session_start();
include('connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete department query
    $query = "DELETE FROM departments WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: departments.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
