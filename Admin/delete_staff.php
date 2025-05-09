<?php
include('connect.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM staff_users WHERE id=$id");
header("Location: staff_management.php");
?>
