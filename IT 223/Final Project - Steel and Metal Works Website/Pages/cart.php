<?php
session_start();

// Include necessary files
include "../PHP/database.php";
include "../PHP/edit_cart.php";

// Get customer session ID
$session_id = $_SESSION["cust_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch POST data
    $cart_id = $_POST['cart-id'];
    $specs = $_POST['order-specs'];
    $quantity = $_POST['order-quantity'];

    // Update shopping cart with new order details
    $sql = "UPDATE SHOPPINGCART SET
                order_specs = '$specs',
                quantity = '$quantity'
            WHERE cart_id = '$cart_id'";

    $result = mysqli_query($conn, $sql);

    // Redirect to cart page with success message or display error
    if ($result) {
        header("Location: cart.php?msg=Order edited successfully");
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
    <title>Shopping Cart</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Styles -->
    <style>
        .modal-content {
            border: solid white 2px;
            border-radius: 1rem;
            background: #2f2f2f;
            padding: 20px;
        }
    </style>

    <!-- Favicon -->
    <link rel="icon" href="../Resources/logo.png">
</head>

<body class="d-inline">
    <!-- Navigation Bar -->
    <nav class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../Resources/logo.png" alt="Shop Logo" style="height: 65px;">
            </a>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item"><a class="nav-link mx-3" href="products.php">
                        <h4>Products</h4>
                    </a></li>
                <?php if (isset($_SESSION["cust_id"])) : ?>
                    <li class="nav-item"><a class="nav-link mx-3" href="cart.php">
                            <h4>Cart</h4>
                        </a></li>
                    <li class="nav-item"><a class="nav-link mx-3" href="account.php">
                            <h4>Account</h4>
                        </a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link mx-3" href="login.php">
                            <h4>Log-In</h4>
                        </a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <section class="container-fluid text-white">
        <!-- Display success message -->
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_GET["msg"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php
        // Fetch shopping cart details for the logged-in customer
        $sql = "SELECT cart_id, shoppingcart.prod_id, prod_name, prod_price, prod_desc, prod_photo, order_specs, quantity
                FROM SHOPPINGCART
                JOIN CUSTOMER ON SHOPPINGCART.cust_id = CUSTOMER.cust_id
                JOIN PRODUCT ON SHOPPINGCART.prod_id = PRODUCT.prod_id
                WHERE shoppingcart.cust_id = '$session_id'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($cart_item = mysqli_fetch_assoc($result)) {
                $cart_id = $cart_item["cart_id"];
        ?>
                <div class="cart-item container p-5 h-100 d-flex align-items-center justify-content-between text-white mt-3">
                    <section class="image-section">
                        <img class="prod-img img-fluid border-white rounded" src="../Resources/Products/<?php echo $cart_item["prod_photo"] ?>" alt="Product Photo">
                    </section>
                    <section class="information-section mw-100 ml-5">
                        <h1><?php echo $cart_item["prod_name"] ?></h1>
                        <h5>Price: <?php echo $cart_item["prod_price"] ?></h5>
                        <h5>Specifications: <?php echo $cart_item["order_specs"] ?></h5>
                        <h5>Quantity: <?php echo $cart_item["quantity"] ?></h5>
                        <div class="button-container my-3 d-flex align-items-center justify-content-between">
                            <button type="button" class="purchase-history-button" data-bs-toggle="modal" data-bs-target="#cartModal<?php echo $cart_id; ?>">Edit Order Details</button>

                            <!-- Modal for editing order details -->
                            <div class="modal fade" id="cartModal<?php echo $cart_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $cart_id; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="container-fluid d-flex justify-content-between align-items-center">
                                            <section class="image-section">
                                                <img class="prod-img border border-white rounded" src="../Resources/Products/<?php echo $cart_item["prod_photo"]; ?>" alt="Product Photo">
                                            </section>
                                            <section>
                                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                    <div class="container-fluid text-white">
                                                        <section class="edit-user-input">
                                                            <h1 class="text-center"><?php echo $cart_item["prod_name"] ?></h1><br>
                                                            <h5>Price: PHP <?php echo $cart_item["prod_price"] ?></h5>
                                                            <h5>Description: <?php echo $cart_item["prod_desc"] ?></h5><br>

                                                            <input type="hidden" name="cart-id" value="<?php echo $cart_item["cart_id"] ?>">
                                                            <input required type="number" class="display-input" placeholder="Quantity" min="1" name="order-quantity" value="<?php echo $cart_item["quantity"] ?>"><br><br>
                                                            <input type="textarea" class="display-input" placeholder="Order Specifications" name="order-specs" value="<?php echo $cart_item["order_specs"] ?>"><br><br>
                                                            <div class="button-container my-3 d-flex align-items-center justify-content-center">
                                                                <button class="edit-profile-button" name="confirm_edit">Confirm Edit</button>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </form>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="../PHP/delete_from_cart.php?cart_id=<?php echo $cart_item["cart_id"] ?>">
                                <button class="logout-button">Remove Order</button>
                            </a>

                            <a href="<?php echo "checkout.php?prod_id=" . $cart_item["prod_id"] . "&quantity=" . $cart_item["quantity"] . "&specs=" . $cart_item["order_specs"] . "&cart_id=" . $cart_item["cart_id"] ?>">
                                <button class="edit-profile-button" name="checkout">Check Out</button>
                            </a>
                        </div>
                    </section>
                </div>
        <?php
            }
        } else {
            echo '
                <div class="text-center d-flex flex-column align-items-center p-5 mt-5"> 
                    <h1 class="text-white">Shopping Cart is empty</h1>
                    <a href="products.php">
                        <button class="btn btn-info mt-3">
                            <h3>Check out our products >></h3>
                        </button>
                    </a>
                </div>';         
        }
        ?>
    </section>
</body>

</html>