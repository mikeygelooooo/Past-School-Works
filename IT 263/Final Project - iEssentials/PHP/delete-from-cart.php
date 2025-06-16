<?php
include "database.php";

// Sanitize the input to prevent SQL injection
$cart_id = filter_input(INPUT_GET, 'cart_id', FILTER_SANITIZE_NUMBER_INT);

if (!$cart_id) {
    die("Invalid cart ID provided");
}

// Prepare the SQL query to delete the record from the CART table
$query = "DELETE FROM CART WHERE cart_id = ?";

// Prepare and bind the statement
$stmt = mysqli_prepare($connection, $query);
if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "i", $cart_id);

// Execute the statement
$result = mysqli_stmt_execute($stmt);

// Check if the query was successful
if ($result) {
    // Redirect to cart page with success message
    header("Location: ../Pages/shoppingcart.php?msg=" . urlencode("Cart item deleted successfully"));
    exit;
} else {
    // Output error message if query failed
    echo "Failed to delete cart item: " . mysqli_error($connection);
}

// Close the statement
mysqli_stmt_close($stmt);
