<?php
include('connect.php');

$mobileNumber = $_POST['mobileNumber'];

$sql = "SELECT lastName, email FROM users WHERE mobileNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobileNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(null);
}
?>
