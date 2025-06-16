<?php
session_start();
include "../PHP/database.php";
include "../PHP/add_to_cart.php";

// Get customer ID from session
$session_id = isset($_SESSION["cust_id"]) ? $_SESSION["cust_id"] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prod_id = $_POST['order-product'];
    $quantity = $_POST['order-quantity'];
    $specs = $_POST['order-specs'];

    if ($_POST['submit'] == 'add_to_cart') {
        $sql = "INSERT INTO SHOPPINGCART (cust_id, prod_id, order_specs, quantity) VALUES ('$session_id', '$prod_id', '$specs', '$quantity')";
        $result = mysqli_query($conn, $sql);

        // Redirect to products page with a success message
        if ($result) {
            header("Location: products.php?msg=Order added to cart");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } elseif ($_POST['submit'] == 'checkout') {
        header("Location: checkout.php?prod_id=$prod_id&quantity=$quantity&specs=$specs&total_payment=$total_payment");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap JS Bundle -->
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
                <a class="nav-link mx-3" href="products.php">
                    <h4>Products</h4>
                </a>
                <?php if ($session_id != 0) : ?>
                    <a class="nav-link mx-3" href="cart.php">
                        <h4>Cart</h4>
                    </a>
                    <a class="nav-link mx-3" href="account.php">
                        <h4>Account</h4>
                    </a>
                <?php else : ?>
                    <a class="nav-link mx-3" href="login.php">
                        <h4>Log-In</h4>
                    </a>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Products Section -->
    <section class="product-display container my-5">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center text-white">Products</h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM PRODUCT";
            $result = mysqli_query($conn, $sql);
            while ($product = mysqli_fetch_assoc($result)) {
                $product_id = $product["prod_id"];
            ?>
                <div class="col-4 mt-3">
                    <div class="p-1 mt-5 d-flex flex-column justify-content-center align-items-center">
                        <img class="card-img img-fluid border border-white rounded mb-3" src="../Resources/Products/<?= $product["prod_photo"] ?>" alt="Product Photo">
                        <h3 class="text-white"><?= $product["prod_name"] ?></h3>

                        <?php if ($session_id != 0) : ?>
                            <button type="button" class="order-button" data-bs-toggle="modal" data-bs-target="#productModal<?= $product_id ?>">Order</button>
                        <?php else : ?>
                            <button type="button" class="order-button" onclick="document.location='login.php'">Order</button>
                        <?php endif; ?>

                        <!-- Product Modal -->
                        <div class="modal fade" id="productModal<?= $product_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $product_id ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="container-fluid d-flex justify-content-between align-items-center">
                                        <section class="image-section">
                                            <img class="prod-img border border-white rounded" src="../Resources/Products/<?= $product["prod_photo"] ?>" alt="Product Photo">
                                        </section>
                                        <section>
                                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                <div class="container-fluid text-white">
                                                    <section class="edit-user-input">
                                                        <h1 class="text-center"><?= $product["prod_name"] ?></h1><br>
                                                        <h5>Price: PHP <?= $product["prod_price"] ?></h5>
                                                        <h5>Description: <?= $product["prod_desc"] ?></h5><br>
                                                        <input type="hidden" name="order-product" value="<?= $product["prod_id"] ?>">
                                                        <input required type="number" class="display-input" placeholder="Quantity" min="1" name="order-quantity"><br><br>
                                                        <input type="textarea" class="display-input" placeholder="Order Specifications" name="order-specs"><br><br>
                                                        <div class="button-container my-3 d-flex align-items-center justify-content-center">
                                                            <button type="submit" class="purchase-history-button" name="submit" value="add_to_cart">Add to Cart</button>
                                                            <button type="submit" class="edit-profile-button" name="submit" value="checkout">Order Now</button>
                                                        </div>
                                                    </section>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Product Modal -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</body>

</html>