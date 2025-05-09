function editAppointment(appointmentId) {
    // Implement the functionality to edit an appointment
    // Redirect to an edit page or show a form to edit the appointment
    window.location.href = 'edit_appointment.php?id=' + appointmentId;
}

function deleteAppointment(appointmentId) {
    if (confirm('Are you sure you want to delete this appointment?')) {
        // Implement the functionality to delete an appointment
        window.location.href = 'delete_appointment.php?id=' + appointmentId;
    }
}