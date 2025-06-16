<?php
// Database configuration
$db_server = "localhost"; // Database server
$db_user = "root";        // Database username
$db_pass = "";            // Database password
$db_name = "manga";    // Database name

// Create connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    // Connection failed, output error message
    die("Connection failed: " . mysqli_connect_error());
}
?>