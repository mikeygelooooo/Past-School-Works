<?php
// Start session
session_start();

// Check if customer is logged in
if (isset($_SESSION["cust_id"])) {
    // Destroy session
    session_destroy();

    // Redirect to login page with logout message
    header("Location: ../Pages/login.php?msg=Logged out successfully");
}
?>