<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $departmentId = $_POST['department'];
    $branch = $_POST['branch'];
    $doctorId = $_POST['doctor'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];

    // Check if the doctor has less than 10 appointments for the selected date
    $sql = "SELECT COUNT(*) as count FROM appointments WHERE doctor_id = $doctorId AND appointment_date = '$appointmentDate'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] >= 10) {
        echo "<script>alert('This doctor already has 10 appointments for the selected date. Please choose another date.'); window.location.href = 'appointment.php';</script>";
        exit();
    }

    // Insert appointment into the database
    $sql = "INSERT INTO appointments (name, age, gender, mobile, email, department_id, branch, doctor_id, appointment_date, appointment_time) 
            VALUES ('$name', $age, '$gender', '$mobile', '$email', $departmentId, '$branch', $doctorId, '$appointmentDate', '$appointmentTime')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href = 'appointment.php';</script>";
    } else {
        echo "<script>alert('Error booking appointment.'); window.location.href = 'appointment.php';</script>";
    }
}
?>