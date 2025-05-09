<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];
    $password = md5($password);

    $checkEmail = "SELECT * FROM users where email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "<script>alert('Email Address Already Exists!'); window.location.href='index.php';</script>";
    } else {
        $insertQuery = "INSERT INTO users(firstName,LastName,email,mobileNumber,password)
                            VALUES ('$firstName','$lastName','$email','$mobileNumber','$password')";
        if ($conn->query($insertQuery) == TRUE) {
            header("location:index.php");
        } else {
            echo "Error:" . $conn->error;
        }
    }
}

session_start(); // Start the session

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password for comparison

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['lastName'] = $row['lastName']; // Store the user's last name in the session
        header("Location: index.php"); // Redirect to the home page
        exit();
    } else {
        echo "<script>alert('Incorrect Email or Password!'); window.location.href='index.php';</script>";
    }
}
?>