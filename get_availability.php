<?php
session_start();
include("connect.php");

if (isset($_GET['doctor_id'])) {
    $doctorId = $_GET['doctor_id'];
    $response = [];

    // Fetch available days and times for the selected doctor
    $sql = "SELECT available_day, available_time FROM doctor_availability WHERE doctor_id = $doctorId";
    $result = mysqli_query($conn, $sql);
    $availableSlots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $availableSlots[] = $row;
    }

    // Prepare response
    $response = [
        'slots' => $availableSlots
    ];

    echo json_encode($response);
}
?>