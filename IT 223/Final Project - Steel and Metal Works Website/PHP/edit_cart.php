<?php
include "database.php";

// Initialize error messages
$quantityErr = $specsErr = "";

// Initialize input variables
$quantity = $specs = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $cart_id = filter_input(INPUT_POST, "cart-id", FILTER_SANITIZE_NUMBER_INT);
    $prod_id = filter_input(INPUT_POST, "order-product", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "order-quantity", FILTER_SANITIZE_NUMBER_INT);
    $specs = filter_input(INPUT_POST, "order-specs", FILTER_SANITIZE_SPECIAL_CHARS);
}
?>