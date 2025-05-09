<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch doctors for dropdown
$doctorQuery = "SELECT d.id, d.name, dep.name AS department FROM doctors d 
                JOIN departments dep ON d.department_id = dep.id";
$doctorResult = mysqli_query($conn, $doctorQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorId = $_POST['doctor_id'];
    $day = $_POST['day'];
    $time = $_POST['time'];

    $insertQuery = "INSERT INTO doctor_availability (doctor_id, available_day, available_time) 
                    VALUES ('$doctorId', '$day', '$time')";

    if (mysqli_query($conn, $insertQuery)) {
        header("Location: doctor_availability.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Doctor Availability</title>
    <link rel="stylesheet" href="doctor_availability.css">
</head>

<body>
    <div class="form-container">
        <h2>Add Doctor Availability</h2>
        <form action="add_availability.php" method="POST">
            <label for="doctor_id">Doctor:</label>
            <select name="doctor_id" required>
                <option value="">-- Select Doctor --</option>
                <?php while ($doctor = mysqli_fetch_assoc($doctorResult)) { ?>
                    <option value="<?= $doctor['id'] ?>">
                        <?= htmlspecialchars($doctor['name']) ?> (<?= htmlspecialchars($doctor['department']) ?>)
                    </option>
                <?php } ?>
            </select>

            <label for="day">Available Day:</label>
            <select name="day" required>
                <option value="">-- Select Day --</option>
                <?php
                $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                foreach ($days as $day) {
                    echo "<option value='$day'>$day</option>";
                }
                ?>
            </select>

            <label for="time">Available Time:</label>
            <input type="text" name="time" required>

            <button type="submit">Add Availability</button>
            <a href="doctor_availability.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</body>

</html>