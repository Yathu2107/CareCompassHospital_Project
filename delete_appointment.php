<?php
session_start();
include("connect.php");

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Delete the appointment from the database
    $sql = "DELETE FROM appointments WHERE id = $appointmentId";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Appointment deleted successfully.');
                window.location.href = 'manageAppointment.php';
            </script>";
    } else {
        echo "<script>
                alert('Error deleting appointment.');
                window.location.href = 'manageAppointment.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'manageAppointment.php';
        </script>";
}
?>