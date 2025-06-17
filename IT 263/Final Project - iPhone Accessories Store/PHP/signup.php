<?php
// Include the database connection file
include "database.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the request is for checking availability of a field
    if (isset($_POST['field']) && isset($_POST['value'])) {
        $field = filter_input(INPUT_POST, "field", FILTER_SANITIZE_SPECIAL_CHARS);
        $value = filter_input(INPUT_POST, "value", FILTER_SANITIZE_SPECIAL_CHARS);

        // Prepare the SQL query based on the field
        if ($field === "name") {
            $query = "SELECT cust_name FROM Customer WHERE cust_name = ?";
        } elseif ($field === "email") {
            $query = "SELECT cust_email FROM Customer WHERE cust_email = ?";
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid field"]);
            exit;
        }

        // Prepare and execute the SQL statement
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $value);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Send the response as JSON
        echo json_encode(["status" => (mysqli_num_rows($result) > 0) ? "exists" : "available"]);

        exit;
    } else {
        // Sanitize and filter the form inputs
        $name = filter_input(INPUT_POST, "signup-name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "signup-email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "signup-password", FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_input(INPUT_POST, "signup-address", FILTER_SANITIZE_SPECIAL_CHARS);

        // Hash the password using the bcrypt algorithm
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query for inserting a new customer
        $query = "INSERT INTO Customer (cust_name, cust_email, cust_password, cust_address)
                  VALUES (?, ?, ?, ?)";

        // Prepare and execute the SQL statement
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $hash, $address);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Redirect to the account forms page with a success message
            header("Location: ../Pages/account-forms.php?msg=Account created successfully");
            exit;
        } else {
            // Display an error message if the insertion fails
            echo "Failed: " . mysqli_error($connection);
        }
    }
}
?>