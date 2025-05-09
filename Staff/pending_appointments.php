<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: staff_login.php");
    exit();
}

// Include database connection
include('connect.php');

// Handle "Not Attended" action
if (isset($_GET['action']) && $_GET['action'] === 'not_attended' && isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // 1) Fetch appointment details from appointments table
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointmentData = $result->fetch_assoc();

    if ($appointmentData) {
        // 2) Insert into completed_appointments table with status = "Patient not attended"
        $insertStmt = $conn->prepare("
            INSERT INTO completed_appointments 
                (appointment_id, name, gender, mobile, department_id, branch, doctor_id, appointment_time, email, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $status = "Patient not attended";
        $insertStmt->bind_param(
            "isssisisss",
            $appointmentData['id'],
            $appointmentData['name'],
            $appointmentData['gender'],
            $appointmentData['mobile'],
            $appointmentData['department_id'],
            $appointmentData['branch'],
            $appointmentData['doctor_id'],
            $appointmentData['appointment_time'],
            $appointmentData['email'],
            $status
        );
        $insertStmt->execute();

        //Delete from appointments table
        $deleteStmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $deleteStmt->bind_param("i", $appointmentId);
        $deleteStmt->execute();
    }
    //Redirect back to pending_appointments.php
    header("Location: pending_appointments.php");
    exit();
}

// Get selected date
$selectedDate = isset($_GET['selected_date']) ? $_GET['selected_date'] : '';
$selectedBranch = isset($_GET['branch']) ? $_GET['branch'] : '';

// Updated query to join doctors table
$query = "
    SELECT 
        a.id,
        a.name AS name,
        a.mobile,
        a.appointment_time,
        a.appointment_date,
        a.branch,
        d.name AS doctor_name
    FROM appointments a
    JOIN doctors d ON a.doctor_id = d.id
    WHERE 
        ('$selectedDate' = '' OR DATE(a.appointment_date) = DATE('$selectedDate'))
        AND ('$selectedBranch' = '' OR a.branch = '$selectedBranch')
    ORDER BY a.appointment_time DESC
";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pending Appointments | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="pending_appointments.css">
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
            <h1 class="tittle">Pending Appointments</h1>

            <!-- Date Filter Form -->
            <form method="GET" action="pending_appointments.php" class="date-filter-form">
                <label for="selected_date">Select Date:</label>
                <input type="date" id="selected_date" name="selected_date" value="<?php echo $selectedDate; ?>">

                <label for="branch">Select Branch:</label>
                <select id="branch" name="branch">
                    <option value="">All Branches</option>
                    <option value="Kandy" <?php echo $selectedBranch == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                    <option value="Colombo" <?php echo $selectedBranch == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                    <option value="Kurunegala" <?php echo $selectedBranch == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala
                    </option>
                </select>

                <button type="submit">Filter</button>
                <button type="button" onclick="clearFilter()">Clear</button>
            </form>

            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Mobile</th>
                        <th>Doctor Name</th>
                        <th>Branch</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['mobile']; ?></td>
                                <td><?php echo $row['doctor_name']; ?></td>
                                <td><?php echo $row['branch']; ?></td>
                                <td><?php echo $row['appointment_date']; ?></td>
                                <td><?php echo $row['appointment_time']; ?></td>
                                <td>

                                    <!-- Print Bill Button (goes to bill_form.php) -->
                                    <a class="print-bill-btn" href="bill_form.php?appointment_id=<?php echo $row['id']; ?>">
                                        Print Bill
                                    </a>

                                    <!-- Not Attended Button -->
                                    <a class="not-attended-btn"
                                        href="pending_appointments.php?action=not_attended&id=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Are you sure this patient did not attend?');">
                                        Not Attended
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No pending appointments found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>

    <script>
        function clearFilter() {
            document.getElementById('selected_date').value = '';
            document.getElementById('branch').value = '';
            document.forms[0].submit();
        }
    </script>
</body>

</html>