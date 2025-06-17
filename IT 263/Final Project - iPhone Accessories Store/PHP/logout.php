<?php
// Start or resume the session
session_start();

// Check if a customer is logged in
if (isset($_SESSION["cust_id"])) {
    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}

// Redirect to login page with logout message
header("Location: ../Pages/account-forms.php?msg=" . urlencode("Logged out successfully"));
exit;
