<?php
include "database.php"; // Include database connection

// Initialize error messages and input variables
$quantityErr = $specsErr = "";
$quantity = $specs = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize product ID, quantity, and specifications inputs
    $prod_id = filter_input(INPUT_POST, "order-product", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "order-quantity", FILTER_SANITIZE_NUMBER_INT);
    $specs = filter_input(INPUT_POST, "order-specs", FILTER_SANITIZE_SPECIAL_CHARS);

    // Fetch product details from the database
    $sql = "SELECT * FROM PRODUCT WHERE prod_id = '$prod_id'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // Calculate total payment
    $price = $product["prod_price"];
    $total_payment = $price * $quantity;
}
?>