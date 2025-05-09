<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO staff_users (firstName, lastName, dateOfBirth, gender, email, password) 
              VALUES ('$firstName', '$lastName', '$dateOfBirth', '$gender', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        header("Location: staff_management.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
