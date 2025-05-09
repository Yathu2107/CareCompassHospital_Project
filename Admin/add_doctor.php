<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorName = mysqli_real_escape_string($conn, $_POST['doctorName']);
    $departmentId = (int) $_POST['departmentId'];
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);

    $sql = "INSERT INTO doctors (name, department_id, branch) 
            VALUES ('$doctorName', $departmentId, '$branch')";

    if (mysqli_query($conn, $sql)) {
        header("Location: doctors.php");
        exit();
    } else {
        echo "Error adding doctor: " . mysqli_error($conn);
    }
}
?>