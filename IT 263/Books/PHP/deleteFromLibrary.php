<?php
include "database.php";

$manga_id = $_GET["manga_id"];

// SQL query to delete the record from the SHOPPINGCART table
$sql = "DELETE FROM MANGA WHERE manga_id = '$manga_id'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Redirect to cart page with success message
    header("Location: ../index.php?msg=Manga deleted successfully");
} else {
    // Output error message if query failed
    echo "Failed: " . mysqli_error($conn);
}
?>