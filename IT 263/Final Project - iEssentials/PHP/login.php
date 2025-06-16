<?php
// Include the database connection file
include "database.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the email input
    $email = filter_input(INPUT_POST, "login-email", FILTER_SANITIZE_EMAIL);

    // Prepare the SQL query
    $query = "SELECT cust_id, cust_email, cust_password FROM Customer WHERE cust_email = ?";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        sendJsonResponse(false, 'database_error');
    }

    // Bind the email parameter and execute
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    $account = mysqli_fetch_assoc($result);

    // Check if the email exists
    if ($account) {
        // Sanitize the password input
        $password = filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_SPECIAL_CHARS);

        // Verify the password
        if (password_verify($password, $account["cust_password"])) {
            // Start the session and store user data
            session_start();
            $_SESSION["cust_id"] = $account["cust_id"];
            $_SESSION["cust_email"] = $account["cust_email"];
            $_SESSION["cust_password"] = $password;

            sendJsonResponse(true);
        } else {
            sendJsonResponse(false, 'password');
        }
    } else {
        sendJsonResponse(false, 'email');
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}

/**
 * Send a JSON response
 *
 * @param bool $success Whether the operation was successful
 * @param string $error Error message (if any)
 */
function sendJsonResponse($success, $error = null)
{
    $response = ['success' => $success];
    if ($error) {
        $response['error'] = $error;
    }
    echo json_encode($response);
    exit;
}
