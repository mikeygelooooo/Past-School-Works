<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve input values
    $cust_id = filter_input(INPUT_POST, "order-customer", FILTER_SANITIZE_NUMBER_INT);
    $acs_id = filter_input(INPUT_POST, "order-accessory", FILTER_SANITIZE_NUMBER_INT);
    $model = filter_input(INPUT_POST, "order-model", FILTER_SANITIZE_NUMBER_INT);
    $color = filter_input(INPUT_POST, "order-color", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "order-quantity", FILTER_SANITIZE_NUMBER_INT);
    $total = filter_input(INPUT_POST, "order-total", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $order_date = mysqli_real_escape_string($connection, $_POST["order-date"]);
    $delivery_date = mysqli_real_escape_string($connection, $_POST["order-delivery"]);
    $cart_id = filter_input(INPUT_POST, "cart-id", FILTER_SANITIZE_NUMBER_INT);

    // Prepare the fields and placeholders for the INSERT query
    $fields = ['cust', 'acs', 'quantity', 'total', 'order_date', 'delivery_date'];
    $placeholders = array_fill(0, count($fields), '?');
    $params = [$cust_id, $acs_id, $quantity, $total, $order_date, $delivery_date];

    // Add model and color if they are set
    if ($model != 0) {
        $fields[] = 'model';
        $placeholders[] = '?';
        $params[] = $model;
    }
    if ($color != 0) {
        $fields[] = 'color';
        $placeholders[] = '?';
        $params[] = $color;
    }

    // Prepare and execute the INSERT query
    $query = "INSERT INTO Orders (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($connection));
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Remove the item from the cart
        $delete_query = "DELETE FROM Cart WHERE cart_id = ?";
        $delete_stmt = mysqli_prepare($connection, $delete_query);
        mysqli_stmt_bind_param($delete_stmt, "s", $cart_id);
        $delete_result = mysqli_stmt_execute($delete_stmt);

        if ($delete_result) {
            // Redirect to the accessories page with a success message
            header("Location: ../Pages/accessories.php?msg=" . urlencode("Order successful"));
            exit;
        } else {
            echo "Failed to remove item from cart: " . mysqli_error($connection);
        }
    } else {
        // Display an error message if the insertion fails
        echo "Failed to create order: " . mysqli_error($connection);
    }
}
