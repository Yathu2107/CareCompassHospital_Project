<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

// Check if an appointment ID is provided
if (!isset($_GET['appointment_id'])) {
    header("Location: pending_appointments.php");
    exit();
}

$appointmentId = $_GET['appointment_id'];

// Fetch appointment data from the appointments table
$stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->bind_param("i", $appointmentId);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();

// If appointment not found, redirect
if (!$appointment) {
    header("Location: pending_appointments.php");
    exit();
}

// If the form is submitted
if (isset($_POST['submit_bill'])) {
    // Get detailed fee values and convert them to float
    $channeling_fee = floatval($_POST['channeling_fee']);
    $doctor_fee = floatval($_POST['doctor_fee']);
    $service_charges = floatval($_POST['service_charges']);
    
    // Calculate total amount
    $totalAmount = $channeling_fee + $doctor_fee + $service_charges;
    
    // Insert detailed invoice into invoices table
    $insert = $conn->prepare("
        INSERT INTO invoices (appointment_id, users_email, channeling_fee, doctor_fee, service_charges, total_amount) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $insert->bind_param("isdddd", 
        $appointmentId, 
        $appointment['email'],  
        $channeling_fee,
        $doctor_fee,
        $service_charges,
        $totalAmount
    );
    $insert->execute();
    
    // Get the last inserted invoice ID
    $invoiceId = $conn->insert_id;
    
    // Insert the appointment details into completed_appointments with status "completed"
    $status = "completed";
    $insertCompleted = $conn->prepare("
        INSERT INTO completed_appointments 
            (appointment_id, name, gender, mobile, department_id, branch, doctor_id, appointment_time, email, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insertCompleted->bind_param("isssisisss",
        $appointment['id'],
        $appointment['name'],
        $appointment['gender'],
        $appointment['mobile'],
        $appointment['department_id'],
        $appointment['branch'],
        $appointment['doctor_id'],
        $appointment['appointment_time'],
        $appointment['email'],
        $status
    );
    $insertCompleted->execute();
    
    // Delete the appointment from appointments table
    $deleteStmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $deleteStmt->bind_param("i", $appointmentId);
    $deleteStmt->execute();
    
    // Redirect to invoice page with the new invoice ID
    header("Location: invoice.php?invoice_id=" . $invoiceId);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Form | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="pending_appointments.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bill-form-container">
        <h2>Bill Form for Appointment #<?php echo $appointmentId; ?></h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Patient Name:</label>
                <input type="text" name="patient_name" value="<?php echo $appointment['name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Patient Email:</label>
                <input type="text" name="patient_email" value="<?php echo $appointment['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Channeling Fee:</label>
                <input type="number" step="0.01" name="channeling_fee" required>
            </div>
            <div class="form-group">
                <label>Doctor Fee:</label>
                <input type="number" step="0.01" name="doctor_fee" required>
            </div>
            <div class="form-group">
                <label>Service Charges:</label>
                <input type="number" step="0.01" name="service_charges" required>
            </div>
            <button class="si-button" type="submit" name="submit_bill">Submit & Generate Invoice</button>
            <button class="cancel-button" onclick="window.location.href='pending_appointments.php'">Cancel</button>
        </form>
    </div>
</body>
</html>
