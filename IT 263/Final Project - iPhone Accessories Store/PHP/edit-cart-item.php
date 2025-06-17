<?php

/**
 * Cart Item Update Script
 * 
 * This script handles the updating of items in the shopping cart.
 * It processes POST data, recalculates the total price, and updates the database accordingly.
 */

include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $cart_id = filter_input(INPUT_POST, "cart-id", FILTER_SANITIZE_NUMBER_INT);
    $acs_id = filter_input(INPUT_POST, "cart-accessory", FILTER_SANITIZE_NUMBER_INT);
    $model = filter_input(INPUT_POST, "cart-model", FILTER_SANITIZE_NUMBER_INT);
    $color = filter_input(INPUT_POST, "cart-color", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "cart-quantity", FILTER_SANITIZE_NUMBER_INT);

    // Fetch the price of the accessory
    $price_query = "SELECT acs_price FROM Accessories WHERE acs_id = ?";
    $price_stmt = mysqli_prepare($connection, $price_query);
    mysqli_stmt_bind_param($price_stmt, "i", $acs_id);
    mysqli_stmt_execute($price_stmt);
    $price_result = mysqli_stmt_get_result($price_stmt);
    $price = mysqli_fetch_assoc($price_result);
    mysqli_stmt_close($price_stmt);

    // Calculate the total price
    $total = $quantity * $price["acs_price"];

    // Prepare the fields for the UPDATE query
    $fields = ['quantity = ?', 'total = ?'];
    $params = [$quantity, $total];
    $types = "di"; // d for double (total), i for integer (quantity)

    if ($model != 0) {
        $fields[] = 'model = ?';
        $params[] = $model;
        $types .= "i";
    }
    if ($color != 0) {
        $fields[] = 'color = ?';
        $params[] = $color;
        $types .= "i";
    }

    // Add cart_id to the parameters
    $params[] = $cart_id;
    $types .= "i";

    // Prepare the UPDATE query
    $query = "UPDATE Cart SET " . implode(', ', $fields) . " WHERE cart_id = ?";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($connection));
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect to the shopping cart page with a success message
        header("Location: ../Pages/shoppingcart.php?msg=" . urlencode("Cart item updated successfully"));
        exit;
    } else {
        // Display an error message if the update fails
        echo "Failed to update cart item: " . mysqli_error($connection);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
