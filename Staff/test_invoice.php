<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $reportName = $_POST['reportName'];
    $reportCharges = $_POST['report_charges'];
    $serviceCharges = $_POST['service_charges'];
    $totalCharges = $reportCharges + $serviceCharges;

    // Store invoice details in the report_invoice table
    $insertQuery = "INSERT INTO report_invoice (request_id, name, mobile_number, email, report_name, report_charges, service_charges, total_charges) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $request_id = $_SESSION['request_id'];
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("issssdds", $request_id, $name, $mobileNumber, $email, $reportName, $reportCharges, $serviceCharges, $totalCharges);

    if ($stmt->execute()) {
        // Fetch the last inserted ID for the invoice number
        $invoiceId = $stmt->insert_id;
    } else {
        die("Error: " . $conn->error);
    }
} else {
    die("Invalid access.");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="request_test.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <div class="invoice-container">
        <h1>Care Compass Hospital</h1><br><br>
        <h2>Invoice #<?php echo $invoiceId; ?></h2>

        <!-- Display basic invoice details -->
        <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($invoiceId); ?></p>
        <p><strong>Request ID:</strong> <?php echo htmlspecialchars($request_id); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($mobileNumber); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p><br>
        <p><strong>Report Name:</strong> <?php echo htmlspecialchars($reportName); ?></p><br>
        <p><strong>Report Charges:</strong> <?php echo htmlspecialchars($reportCharges); ?></p>
        <p><strong>Service Charges:</strong> <?php echo htmlspecialchars($serviceCharges); ?></p><br>
        <p><strong>Total Amount:</strong> $<?php echo htmlspecialchars($totalCharges); ?></p><br>

        <button class="print-button" onclick="window.print()">Print</button>
        <button class="home-button" onclick="window.location.href='request_test.php'">Home</button>
    </div>
</body>

</html>
