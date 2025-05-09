<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobileNumber = $_POST['mobileNumber'];
    $reportName = $_POST['reportName'];

    $sql = "SELECT lastName, email FROM users WHERE mobileNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mobileNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("User not found.");
    }

    $user = $result->fetch_assoc();
    $name = $user['lastName'];
    $email = $user['email'];

    // Store form details in test_requests table
    $insertQuery = "INSERT INTO test_requests (name, mobile_number, email, report_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $name, $mobileNumber, $email, $reportName);

    if ($stmt->execute()) {
        $_SESSION['request_id'] = $stmt->insert_id; // Store request ID in session
        header("Location: test_bill_form.php?request_id=" . $stmt->insert_id);
        exit();
    } else {
        die("Error: " . $conn->error);
    }
} else {
    $request_id = $_GET['request_id'];

    // Fetch details from test_requests
    $sql = "SELECT * FROM test_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        die("Request not found.");
    }
    $request = $result->fetch_assoc();
    $name = $request['name'];
    $mobileNumber = $request['mobile_number'];
    $email = $request['email'];
    $reportName = $request['report_name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Form | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="request_test.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bill-form-container">
        <h2>Bill Form for Laboratory Reports</h2>
        <form method="POST" action="test_invoice.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number:</label>
                <input type="tel" id="mobileNumber" name="mobileNumber" value="<?php echo htmlspecialchars($mobileNumber); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="reportName">Report:</label>
                <input type="text" id="reportName" name="reportName" value="<?php echo htmlspecialchars($reportName); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Report Charges:</label>
                <input type="number" step="0.01" name="report_charges" required>
            </div>
            <div class="form-group">
                <label>Service Charges:</label>
                <input type="number" step="0.01" name="service_charges" required>
            </div>
            <button class="si-button" type="submit">Generate Invoice</button>
        </form>
    </div>
</body>
</html>
