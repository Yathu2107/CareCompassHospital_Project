<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

include('connect.php');

// Fetch pending reports from test_requests table
$pending_reports = [];
$sql = "SELECT * FROM test_requests";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $pending_reports[] = $row;
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['reportFile'])) {
    $request_id = $_POST['request_id'];
    $file = $_FILES['reportFile'];

    $target_dir = "uploads/";
    // Ensure the uploads directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($file["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($file_type != "pdf") {
        echo "Only PDF files are allowed.";
        exit();
    }

    // Upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Fetch report details from test_requests
        $sql = "SELECT * FROM test_requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $report = $result->fetch_assoc();

        // Insert completed report details into completed_report_request table
        $insertQuery = "INSERT INTO completed_report_request (request_id, name, mobile_number, email, report_name, file_path) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param(
            "isssss",
            $request_id,
            $report['name'],
            $report['mobile_number'],
            $report['email'],
            $report['report_name'],
            $target_file
        );

        if ($stmt->execute()) {
            // Remove the report from the test_requests table
            $deleteQuery = "DELETE FROM test_requests WHERE id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("i", $request_id);
            $stmt->execute();

            // Set a session variable to indicate success
            $_SESSION['upload_success'] = true;

            // Redirect to avoid resubmission on refresh
            header("Location: pending_reports.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pending Reports | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="pending_reports.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <div class="staff-container">
        <nav class="sidebar">
            <h2>Staff Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="user_List.php">User List</a></li>
                <li>
                    <a href="#">Doctor List ▼</a>
                    <ul class="dropdown">
                        <li><a href="departments.php">Departments</a></li>
                        <li><a href="doctors.php">Doctors</a></li>
                        <li><a href="doctor_availability.php">Doctor Availability</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Appointments ▼</a>
                    <ul class="dropdown">
                        <li><a href="pending_appointments.php">Pending Appointments</a></li>
                        <li><a href="completed_appointments.php">Completed Appointments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Laboratory Tests ▼</a>
                    <ul class="dropdown">
                        <li><a href="request_test.php">Request for Test</a></li>
                        <li><a href="pending_reports.php">Pending Reports</a></li>
                        <li><a href="completed_reports.php">Completed Reports</a></li>
                    </ul>
                </li>
                <li><a href="feedback.php">Ratings & Feedback</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h1 class="tittle">Pending Reports</h1>

            <!-- Display pending reports -->
            <?php if (isset($_SESSION['upload_success']) && $_SESSION['upload_success']): ?>
                <script>
                    alert("Report successfully uploaded.");
                    <?php unset($_SESSION['upload_success']); ?>
                </script>
            <?php endif; ?>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Report Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_reports as $report): ?>
                        <tr>
                            <td><?php echo $report['id']; ?></td>
                            <td><?php echo $report['name']; ?></td>
                            <td><?php echo $report['mobile_number']; ?></td>
                            <td><?php echo $report['email']; ?></td>
                            <td><?php echo $report['report_name']; ?></td>
                            <td>
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="request_id" value="<?php echo $report['id']; ?>">
                                    <input type="file" name="reportFile" required>
                                    <button class="up-btn" type="submit">Upload</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>

</html>