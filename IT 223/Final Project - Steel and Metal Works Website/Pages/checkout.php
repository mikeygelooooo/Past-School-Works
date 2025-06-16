<?php
session_start();
include "../PHP/database.php";

// Get the customer ID from the session
$session_id = $_SESSION["cust_id"];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cart_id = filter_input(INPUT_POST, "cart-id", FILTER_SANITIZE_NUMBER_INT);; 
    $prod_id = filter_input(INPUT_POST, "order-product", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, "order-quantity", FILTER_SANITIZE_NUMBER_INT);
    $specs = filter_input(INPUT_POST, "order-specs", FILTER_SANITIZE_SPECIAL_CHARS);
    $total_payment = filter_input(INPUT_POST, "total-payment", FILTER_SANITIZE_NUMBER_FLOAT);
    $order_date = $_POST['order-date'];
    $delivery_option = filter_input(INPUT_POST, "delivery-option", FILTER_SANITIZE_SPECIAL_CHARS);
    $delivery_date = $_POST['delivery-date'];

    // Insert order into the database
    $sql = "INSERT INTO ORDERS (cust_id, prod_id, order_specs, quantity, total_payment, order_date, delivery_option, delivery_date) 
            VALUES ('$session_id', '$prod_id', '$specs', '$quantity', '$total_payment', '$order_date', '$delivery_option', '$delivery_date')";
    $result = mysqli_query($conn, $sql);

    // Redirect to products page if the order was successful
    if ($result) {
        if ($cart_id != 0) {
            // Delete the item from the shopping cart
            $sql = "DELETE FROM SHOPPINGCART WHERE cart_id = '$cart_id'";
            mysqli_query($conn, $sql);
        }
        header("Location: products.php?msg=Order Completed");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href="../Resources/logo.png">
</head>

<body class="d-inline">
    <section class="checkout-main container p-5">
        <?php
        // Display success message if available
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>
        <div class="checkout-card container-fluid d-flex justify-content-between align-items-center">
            <?php
            // Retrieve product details from the URL parameters
            $cart_id = isset($_GET['cart_id']) ? $_GET['cart_id'] : 0;
            $prod_id = $_GET['prod_id'];
            $quantity = $_GET['quantity'];
            $specs = $_GET['specs'];

            // Fetch product information from the database
            $sql = "SELECT * FROM PRODUCT WHERE prod_id = '$prod_id'";
            $result = mysqli_query($conn, $sql);
            $order_item = mysqli_fetch_assoc($result);
            $total_payment = $quantity * $order_item["prod_price"];
            $order_date = date('Y-m-d', time());
            $delivery_date = date('Y-m-d', strtotime('+15 days', strtotime($order_date)));
            ?>
            <section class="image-section">
                <img class="prod-img border border-white rounded" src="../Resources/Products/<?php echo $order_item["prod_photo"]; ?>" alt="Product Photo">
            </section>
            <section>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="container-fluid text-white">
                        <section class="edit-user-input">
                            <!-- Hidden inputs for form data -->
                            <input type="hidden" name="cart-id" value="<?php echo $cart_id ?>">
                            <input type="hidden" name="order-product" value="<?php echo $prod_id ?>">
                            <h1 class="text-center"><?php echo $order_item["prod_name"] ?></h1><br>
                            <h5>Price: PHP <?php echo $order_item["prod_price"] ?></h5>
                            <h5>Description: <?php echo $order_item["prod_desc"] ?></h5><br>
                            <h3 class="text-center">Order Details:</h3>
                            <input type="hidden" name="order-quantity" value="<?php echo $quantity ?>">
                            <h5>Quantity: <?php echo $quantity ?></h5>
                            <input type="hidden" name="order-specs" value="<?php echo $specs ?>">
                            <h5>Order Specifications: <?php echo $specs ?></h5>
                            <input type="hidden" name="total-payment" value="<?php echo $total_payment ?>">
                            <h5>Total Payment: PHP <?php echo $total_payment ?>.00</h5><br>
                            <input type="hidden" name="order-date" value="<?php echo $order_date ?>">
                            <div>
                                <h5>Delivery Option:</h5>
                                <select class="form-select" name="delivery-option">
                                    <option value="Delivery">Delivery</option>
                                    <option value="Pick-Up">Pick-Up</option>
                                </select>
                            </div>
                            <input type="hidden" name="delivery-date" value="<?php echo $delivery_date ?>">


                            <!-- Checkout button -->
                            <div class="button-container my-3 d-flex align-items-center justify-content-center">
                                <button type="submit" class="edit-profile-button" name="add_to_cart">Check Out</button>
                            </div>
                        </section>
                    </div>
                </form>
            </section>
        </div>
    </section>
</body>

</html>