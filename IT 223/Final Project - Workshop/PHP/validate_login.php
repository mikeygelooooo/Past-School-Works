<?php
include "database.php";

// Initialize error messages and input variables
$emailErr = $passwordErr = "";
$email = $password = "";
$submit = true;

// Form validation on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email input
    $email = filter_input(INPUT_POST, "login-email", FILTER_SANITIZE_EMAIL);

    $sql = "SELECT email FROM CUSTOMER WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $emailErr = "Email does not exist"; // No email in database
        $submit = false;
    }

    // Validate password input
    $password = filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!preg_match("/^[a-zA-Z-' ]*$/", $password)) {
        $passwordErr = "Invalid Password"; // Contains special characters
        $submit = false;
    }
}
?>