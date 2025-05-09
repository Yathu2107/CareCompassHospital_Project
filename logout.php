<?php
session_start(); // Start the session
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session

// Redirect to the home page
header("Location: index.php");
exit();
?>