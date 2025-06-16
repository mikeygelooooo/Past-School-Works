<?php
include "database.php";

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve input values
    $cust_id = filter_input(INPUT_POST, "order-customer", FILTER_SANITIZE_NUMBER_INT);
    $acs_id = filter_input(INPUT_POST, "order-accessory", FILTER_SANITIZE_NUMBER_INT);
    $model = filter_input(INPUT_POST, "order-model", FILTER_SANITIZE_NUMBER_INT);
    $color = filter_input(INPUT_POST, "order-color", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "order-quantity", FILTER_SANITIZE_NUMBER_INT);

    // Fetch the price of the accessory
    $price_query = "SELECT acs_price FROM Accessories WHERE acs_id = ?";
    $stmt = mysqli_prepare($connection, $price_query);
    mysqli_stmt_bind_param($stmt, "i", $acs_id);
    mysqli_stmt_execute($stmt);
    $price_result = mysqli_stmt_get_result($stmt);
    $price = mysqli_fetch_assoc($price_result);

    // Calculate the total price
    $total = $quantity * $price["acs_price"];

    // Prepare the fields and placeholders for the INSERT query
    $fields = ['cust', 'acs', 'quantity', 'total'];
    $placeholders = array_fill(0, count($fields), '?');
    $params = [$cust_id, $acs_id, $quantity, $total];
    $types = "iiid"; // integer, integer, integer, double

    // Add model and color if they are set
    if ($model != 0) {
        $fields[] = 'model';
        $placeholders[] = '?';
        $params[] = $model;
        $types .= "i";
    }
    if ($color != 0) {
        $fields[] = 'color';
        $placeholders[] = '?';
        $params[] = $color;
        $types .= "i";
    }

    // Prepare and execute the INSERT query
    $query = "INSERT INTO Cart (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($connection));
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect to the accessories page with a success message
        header("Location: ../Pages/accessories.php?msg=" . urlencode("Order added to cart"));
        exit;
    } else {
        // Display an error message if the insertion fails
        echo "Failed to add item to cart: " . mysqli_error($connection);
    }
}
