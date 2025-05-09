<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

// Check if invoice_id is set
if (!isset($_GET['invoice_id'])) {
    header("Location: pending_appointments.php");
    exit();
}

$invoiceId = $_GET['invoice_id'];

// 1) Fetch invoice data
$stmt = $conn->prepare("SELECT * FROM invoices WHERE id = ?");
$stmt->bind_param("i", $invoiceId);
$stmt->execute();
$result = $stmt->get_result();
$invoice = $result->fetch_assoc();

if (!$invoice) {
    header("Location: pending_appointments.php");
    exit();
}

// 2) Optionally fetch appointment data if you want to show more details on the invoice
$appointmentStmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$appointmentStmt->bind_param("i", $invoice['appointment_id']);
$appointmentStmt->execute();
$appointmentResult = $appointmentStmt->get_result();
$appointmentData = $appointmentResult->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?php echo $invoiceId; ?> | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="pending_appointments.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="invoice-container">
        <h1>Care Compass Hospital</h1><br><br>
        <h2>Invoice #<?php echo $invoiceId; ?></h2>
        
        <!-- Display basic invoice details -->
        <p><strong>Invoice ID :</strong> <?php echo $invoice['id']; ?></p>
        <p><strong>Appointment ID :</strong> <?php echo $invoice['appointment_id']; ?></p>
        <p><strong>Patient Email :</strong> <?php echo $invoice['users_email']; ?></p><br>
        <p><strong>Channeling Fee :</strong> <?php echo $invoice['channeling_fee']; ?></p>
        <p><strong>Doctor Fee :</strong> <?php echo $invoice['doctor_fee']; ?></p>
        <p><strong>Service Charges :</strong> <?php echo $invoice['service_charges']; ?></p><br>
        <p><strong>Total Amount :</strong> $<?php echo $invoice['total_amount']; ?></p><br>
        <p><strong>Invoice Date :</strong> <?php echo $invoice['invoice_date']; ?></p>

        <!-- Optionally show patient name from appointments table -->
        <?php if ($appointmentData): ?>
            <p><strong>Patient Name:</strong> <?php echo $appointmentData['name']; ?></p>
            <!-- Add more fields if needed, e.g. appointment time, doctor, etc. -->
        <?php endif; ?>

        <button class="print-button" onclick="window.print()">Print</button>
        <button class="home-button" onclick="window.location.href='pending_appointments.php'">Home</button>
    </div>
</body>
</html>
