<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check user availability
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['id'])) {
        checkUserAvailability($connection);
    } else {
        // Update user information
        updateUserInformation($connection);
    }
}

/**
 * Check if the provided username and email are available
 *
 * @param mysqli $connection Database connection object
 */
function checkUserAvailability($connection) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    $stmt = mysqli_prepare($connection, "SELECT cust_name, cust_email FROM Customer WHERE (cust_name = ? OR cust_email = ?) AND cust_id != ?");
    mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $existingName = $existingEmail = false;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['cust_name'] == $name) $existingName = true;
        if ($row['cust_email'] == $email) $existingEmail = true;
    }

    header('Existing-Name: ' . ($existingName ? 'true' : 'false'));
    header('Existing-Email: ' . ($existingEmail ? 'true' : 'false'));
    echo ($existingName || $existingEmail) ? "exists" : "available";

    mysqli_stmt_close($stmt);
    exit;
}

/**
 * Update user information in the database
 *
 * @param mysqli $connection Database connection object
 */
function updateUserInformation($connection) {
    $id = filter_input(INPUT_POST, "edit-id", FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, "edit-name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "edit-email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "edit-password", FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, "edit-address", FILTER_SANITIZE_SPECIAL_CHARS);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($connection, "UPDATE Customer SET cust_name = ?, cust_email = ?, cust_password = ?, cust_address = ? WHERE cust_id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $hash, $address, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION["cust_email"] = $email;
        $_SESSION["cust_password"] = $password;
        header("Location: ../Pages/account.php?msg=" . urlencode("Account edited successfully"));
    } else {
        echo "Failed to update account: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    exit;
}
?>