function updateDoctors() {
    const departmentId = document.getElementById("department").value;
    const branch = document.getElementById("branch").value;
    const doctorSelect = document.getElementById("doctor");
    const options = doctorSelect.querySelectorAll("option");

    // Hide all doctors initially except the placeholder option
    options.forEach(option => {
        if (option.value !== "") {
            option.style.display = "none";
        }
    });

    // Show doctors belonging to the selected department and branch
    options.forEach(option => {
        if (option.getAttribute("data-department") === departmentId && option.getAttribute("data-branch") === branch) {
            option.style.display = "block";
        }
    });

    // Reset doctor selection
    doctorSelect.value = "";
    document.getElementById("appointment_date").value = "";
    document.getElementById("appointment_time").innerHTML = "";
}

function updateDates() {
    const doctorId = document.getElementById("doctor").value;
    if (!doctorId) return;

    fetch(`get_availability.php?doctor_id=${doctorId}`)
        .then(response => response.json())
        .then(data => {
            const dateInput = document.getElementById("appointment_date");
            const timeSelect = document.getElementById("appointment_time");

            // Clear input and time options
            dateInput.value = "";
            timeSelect.innerHTML = "";

            const availableDays = new Set();
            const availableTimes = {};

            // Populate available days and times
            data.slots.forEach(slot => {
                availableDays.add(slot.available_day);
                if (!availableTimes[slot.available_day]) {
                    availableTimes[slot.available_day] = [];
                }
                availableTimes[slot.available_day].push(slot.available_time);
            });

            const formatDate = (date) => date.toISOString().split('T')[0];

            // Generate available dates
            const minDate = new Date();
            const maxDate = new Date();
            maxDate.setMonth(maxDate.getMonth() + 1); // One month from now

            const availableDates = [];
            let currentDate = new Date(minDate);
            while (currentDate <= maxDate) {
                const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'long' });
                if (availableDays.has(dayOfWeek)) {
                    availableDates.push(new Date(currentDate));
                }
                currentDate.setDate(currentDate.getDate() + 1);
            }

            // Ensure there are valid available dates before setting min/max
            if (availableDates.length > 0) {
                dateInput.setAttribute("min", formatDate(availableDates[0]));
                dateInput.setAttribute("max", formatDate(availableDates[availableDates.length - 1]));
            } else {
                dateInput.removeAttribute("min");
                dateInput.removeAttribute("max");
            }

            dateInput.addEventListener("change", () => {
                const selectedDate = new Date(dateInput.value);
                const dayOfWeek = selectedDate.toLocaleDateString('en-US', { weekday: 'long' });

                if (!availableDays.has(dayOfWeek)) {
                    dateInput.setCustomValidity("Please select an available date.");
                    dateInput.reportValidity();
                    timeSelect.innerHTML = "";
                } else {
                    dateInput.setCustomValidity("");
                    timeSelect.innerHTML = "";

                    if (availableTimes[dayOfWeek]) {
                        availableTimes[dayOfWeek].forEach(time => {
                            const option = document.createElement("option");
                            option.value = time;
                            option.textContent = time;
                            timeSelect.appendChild(option);
                        });
                    }
                }
            });
        })
        .catch(error => console.error("Error fetching availability:", error));
}