<?php
include "database.php";

// Retrieve session variables
$session_id = $_SESSION["cust_id"];
$session_email = $_SESSION["email"];
$session_number = $_SESSION["number"];

// Fetch account details
$sql = "SELECT * FROM CUSTOMER WHERE cust_id = '$session_id'";
$result = mysqli_query($conn, $sql);
$account = mysqli_fetch_assoc($result);

// Initialize error messages and input variables
$nameErr = $emailErr = $passwordErr = $addressErr = $numberErr = "";
$fname = $lname = $email = $password = $address = $number = "";
$submit = true;

// Form validation on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    $fname = filter_input(INPUT_POST, "edit-fname", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $nameErr = "Invalid Name"; // Contains special characters
        $submit = false;
    }

    // Validate last name
    $lname = filter_input(INPUT_POST, "edit-lname", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $nameErr = "Invalid Name"; // Contains special characters
        $submit = false;
    }

    // Validate email
    $email = filter_input(INPUT_POST, "edit-email", FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid Email"; // Invalid email format
        $submit = false;
    } else {
        // Check for duplicate email
        $sql = "SELECT email FROM CUSTOMER WHERE email != '$session_email' AND email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $emailErr = "Email is taken"; // Duplicate email
            $submit = false;
        }
    }

    // Validate password
    if (empty($_POST["edit-password"])) {
        $password_hash = $account["cust_password"];
    } else {
        $password = filter_input(INPUT_POST, "edit-password", FILTER_SANITIZE_SPECIAL_CHARS);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $password)) {
            $passwordErr = "Invalid Password"; // Contains special characters
            $submit = false;
        } else {
            // Hash the new password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    // Validate address
    $address = filter_input(INPUT_POST, "edit-address", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate phone number
    $number = filter_input(INPUT_POST, "edit-number", FILTER_SANITIZE_NUMBER_INT);
    if (!preg_match("/^(09|\+639)\d{9}$/", $number)) {
        $numberErr = "Invalid Number"; // Invalid number format
        $submit = false;
    } else {
        // Check for duplicate phone number
        $sql = "SELECT contact_number FROM CUSTOMER WHERE contact_number != '$session_number' AND contact_number = '$number'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $numberErr = "Contact Number is taken"; // Duplicate number
            $submit = false;
        }
    }
}
?>