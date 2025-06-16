<?php
// Include the database connection file
include "database.php";

// Get the cart_id from the GET request
$cart_id = $_GET["cart_id"];

// SQL query to delete the record from the SHOPPINGCART table
$sql = "DELETE FROM SHOPPINGCART WHERE cart_id = '$cart_id'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Redirect to cart page with success message
    header("Location: ../Pages/cart.php?msg=Order deleted successfully");
} else {
    // Output error message if query failed
    echo "Failed: " . mysqli_error($conn);
}
?>