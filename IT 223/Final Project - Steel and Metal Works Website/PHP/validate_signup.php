<?php
include "database.php";

// Initialize error messages and input variables
$nameErr = $emailErr = $passwordErr = $addressErr = $numberErr = "";
$fname = $lname = $email = $password = $address = $number = "";
$submit = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name input
    $fname = filter_input(INPUT_POST, "signup-fname", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $nameErr = "Invalid Name"; // Contains special characters
        $submit = false;
    }

    // Validate last name input
    $lname = filter_input(INPUT_POST, "signup-lname", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $nameErr = "Invalid Name"; // Contains special characters
        $submit = false;
    }

    // Validate email input
    $email = filter_input(INPUT_POST, "signup-email", FILTER_SANITIZE_EMAIL);
    $sql = "SELECT email from CUSTOMER WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $emailErr = "Email is taken"; // Duplicate email
        $submit = false;
    }

    // Validate password input and create password hash
    $password = filter_input(INPUT_POST, "signup-password", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $password)) {
        $passwordErr = "Invalid Password"; // Contains special characters
        $submit = false;
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    }

    // Sanitize address input
    $address = filter_input(INPUT_POST, "signup-address", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate number input
    $number = filter_input(INPUT_POST, "signup-number", FILTER_SANITIZE_NUMBER_INT);
    if (!preg_match("/^(09|\+639)\d{9}$/", $number)) {
        $numberErr = "Invalid Number"; // Invalid number format
        $submit = false;
    } else {
        $sql = "SELECT contact_number FROM CUSTOMER WHERE contact_number = '$number'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $numberErr = "Contact Number is taken"; // Duplicate number
            $submit = false;
        }
    }
}
?>