<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Fetch appointment details
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];
    $sql = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $appointment = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Invalid appointment ID.'); window.location.href = 'manageAppointment.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No appointment ID specified.'); window.location.href = 'manageAppointment.php';</script>";
    exit();
}

// Fetch all doctors and departments
$doctors = [];
$sql = "SELECT * FROM doctors";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $doctors[] = $row;
}

$departments = [];
$sql = "SELECT * FROM departments";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

// Update appointment details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $departmentId = $_POST['department'];
    $branch = $_POST['branch'];
    $doctorId = $_POST['doctor'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];

    $sql = "UPDATE appointments SET name='$name', age=$age, gender='$gender', mobile='$mobile', email='$email', department_id=$departmentId, branch='$branch', doctor_id=$doctorId, appointment_date='$appointmentDate', appointment_time='$appointmentTime' WHERE id=$appointmentId";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment updated successfully!'); window.location.href = 'manageAppointment.php';</script>";
    } else {
        echo "<script>alert('Error updating appointment.'); window.location.href = 'edit_appointment.php?id=$appointmentId';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment | Care Compass Hospitals</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" href="manageAppointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Edit Appointment Section -->
    <section class="appointment-section">
        <div class="appointment-container">
            <h2>Edit Appointment</h2>
            <form id="editAppointmentForm" action="edit_appointment.php?id=<?php echo $appointmentId; ?>" method="post">
                <label for="name">Name :</label>
                <input type="text" id="name" name="name" value="<?php echo $appointment['name']; ?>" required>

                <label for="age">Age :</label>
                <input type="number" id="age" name="age" value="<?php echo $appointment['age']; ?>" required>

                <label for="gender">Gender :</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="Male" <?php echo ($appointment['gender'] == 'Male') ? 'checked' : ''; ?> required> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php echo ($appointment['gender'] == 'Female') ? 'checked' : ''; ?> required> Female</label>
                    <label><input type="radio" name="gender" value="Other" <?php echo ($appointment['gender'] == 'Other') ? 'checked' : ''; ?> required> Other</label>
                </div>

                <label for="mobile">Mobile Number :</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $appointment['mobile']; ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $appointment['email']; ?>" readonly
                    required>

                <label for="department">Select Department :</label>
                <select id="department" name="department" onchange="updateDoctors()" required>
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id']; ?>" <?php echo ($appointment['department_id'] == $department['id']) ? 'selected' : ''; ?>>
                            <?php echo $department['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="branch">Select Branch :</label>
                <select id="branch" name="branch" onchange="updateDoctors()" required>
                    <option value="">Select Branch</option>
                    <option value="Colombo" <?php echo ($appointment['branch'] == 'Colombo') ? 'selected' : ''; ?>>Colombo
                    </option>
                    <option value="Kandy" <?php echo ($appointment['branch'] == 'Kandy') ? 'selected' : ''; ?>>Kandy
                    </option>
                    <option value="Kurunegala" <?php echo ($appointment['branch'] == 'Kurunegala') ? 'selected' : ''; ?>>
                        Kurunegala</option>
                </select>

                <label for="doctor">Select Doctor :</label>
                <select id="doctor" name="doctor" onchange="updateDates()" required>
                    <option value="">Select Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                    <option value="<?php echo $doctor['id']; ?>"
                        data-department="<?php echo $doctor['department_id']; ?>"
                        data-branch="<?php echo $doctor['branch']; ?>" 
                        <?php echo ($appointment['doctor_id'] == $doctor['id']) ? 'selected' : ''; ?>>
                        <?php echo $doctor['name']; ?>
                    </option>
                     <?php endforeach; ?>
                </select>

                <label for="appointment_date">Select Date :</label>
                <input type="date" id="appointment_date" name="appointment_date"
                    value="<?php echo $appointment['appointment_date']; ?>" required>

                <label for="appointment_time">Select Time :</label>
                <select id="appointment_time" name="appointment_time" required>
                    <option value="">Select Time</option>
                    <?php
                    if (isset($appointment['doctor_id']) && isset($appointment['appointment_date'])) {
                        // Fetch available times for the selected doctor and date
                        $doctorId = $appointment['doctor_id'];
                        $appointmentDate = $appointment['appointment_date'];
                        $sql = "SELECT available_time FROM doctor_availability WHERE doctor_id = $doctorId AND available_day = DAYNAME('$appointmentDate')";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $time = $row['available_time'];
                            echo "<option value='$time' " . ($appointment['appointment_time'] == $time ? 'selected' : '') . ">$time</option>";
                        }
                    }
                    ?>
                </select>

                <button type="submit">Update Appointment</button>
                <button class="cancel-btn" type="button"
                    onclick="window.location.href='manageAppointment.php';">Cancel</button>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            updateDoctors(); // Ensure doctors are filtered when the page loads
        });

        // Function to filter doctors based on department selection
        function updateDoctors() {
            const departmentId = document.getElementById("department").value;
            const branch = document.getElementById("branch").value;
            const doctorSelect = document.getElementById("doctor");

            // Hide all doctor options initially
            Array.from(doctorSelect.options).forEach(option => {
                if (option.value !== "") {
                    option.style.display = "none";
                }
            });

            // Show only relevant doctors
            Array.from(doctorSelect.options).forEach(option => {
                const optionDepartment = option.getAttribute("data-department");
                const optionBranch = option.getAttribute("data-branch");
                if (optionDepartment === departmentId && optionBranch === branch) {
                    option.style.display = "block";
                }
            });

            // Reset the selected doctor
            doctorSelect.value = "";
            updateDates(); // Refresh dates when doctor changes
        }

        // Function to fetch available dates & times for selected doctor
        function updateDates() {
            const doctorId = document.getElementById("doctor").value;
            const dateInput = document.getElementById("appointment_date");
            const timeSelect = document.getElementById("appointment_time");

            // Reset date & time fields
            dateInput.value = "";
            timeSelect.innerHTML = "<option value=''>Select Time</option>";

            if (!doctorId) return;

            fetch(`get_availability.php?doctor_id=${doctorId}`)
                .then(response => response.json())
                .then(data => {
                    const availableDays = new Set();
                    const availableTimes = {};

                    data.slots.forEach(slot => {
                        availableDays.add(slot.available_day);
                        if (!availableTimes[slot.available_day]) {
                            availableTimes[slot.available_day] = [];
                        }
                        availableTimes[slot.available_day].push(slot.available_time);
                    });

                    // Set available date range
                    const minDate = new Date();
                    const maxDate = new Date();
                    maxDate.setMonth(maxDate.getMonth() + 1);

                    // Find available dates
                    const getAvailableDates = () => {
                        const dates = [];
                        let currentDate = new Date(minDate);
                        while (currentDate <= maxDate) {
                            const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'long' });
                            if (availableDays.has(dayOfWeek)) {
                                dates.push(new Date(currentDate));
                            }
                            currentDate.setDate(currentDate.getDate() + 1);
                        }
                        return dates;
                    };

                    const availableDates = getAvailableDates();
                    if (availableDates.length > 0) {
                        dateInput.setAttribute("min", availableDates[0].toISOString().split('T')[0]);
                        dateInput.setAttribute("max", availableDates[availableDates.length - 1].toISOString().split('T')[0]);

                        dateInput.addEventListener("change", function () {
                            const selectedDate = new Date(dateInput.value);
                            const dayOfWeek = selectedDate.toLocaleDateString('en-US', { weekday: 'long' });

                            if (!availableDays.has(dayOfWeek)) {
                                dateInput.setCustomValidity('Please select an available date.');
                                timeSelect.innerHTML = "<option value=''>Select Time</option>";
                            } else {
                                dateInput.setCustomValidity('');
                                timeSelect.innerHTML = "<option value=''>Select Time</option>";

                                if (availableTimes[dayOfWeek]) {
                                    availableTimes[dayOfWeek].forEach(time => {
                                        const option = document.createElement("option");
                                        option.value = time;
                                        option.textContent = time;
                                        timeSelect.appendChild(option);
                                    });

                                    // Automatically select the first available time
                                    if (availableTimes[dayOfWeek].length > 0) {
                                        timeSelect.value = availableTimes[dayOfWeek][0];
                                    }
                                }
                            }
                        });

                        // Auto-select the first available date
                        dateInput.value = availableDates[0].toISOString().split('T')[0];
                        dateInput.dispatchEvent(new Event("change")); // Trigger change event to auto-select time
                    } else {
                        alert("No available dates for this doctor.");
                        dateInput.value = "";
                        timeSelect.innerHTML = "<option value=''>Select Time</option>";
                    }
                })
                .catch(error => console.error("Error fetching availability:", error));
        }
    </script>
</body>

</html>