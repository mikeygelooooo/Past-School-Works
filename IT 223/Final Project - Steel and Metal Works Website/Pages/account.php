<?php
session_start();

include "../PHP/validate_account_edit.php";
include "../PHP/database.php";

$session_id = $_SESSION["cust_id"];
$session_email = $_SESSION["email"];
$session_number = $_SESSION["number"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($submit) {
        $sql = "UPDATE CUSTOMER SET
                    email = '$email',
                    cust_password = '$password_hash', 
                    fname = '$fname',
                    lname = '$lname',
                    cust_address = '$address',
                    contact_number = '$number'
                WHERE cust_id = '$session_id'";

        $result = mysqli_query($conn, $sql);

        $_SESSION["email"] = $email;
        $_SESSION["number"] = $number;

        // redirect to login page and display success message
        if ($result) {
            header("Location: account.php?msg=Account edited successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }

        exit;
    } else {
        header("msg=Account edit unsuccessful");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <!-- stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .modal-content {
            border: solid white 2px;
            border-radius: 1rem;
            background: #2f2f2f;
            padding: 20px;
        }
    </style>
    <!-- icon -->
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
                <li class="nav-item">
                    <a class="nav-link mx-3" href="products.php">
                        <h4>Products</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="cart.php">
                        <h4>Cart</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="account.php">
                        <h4>Account</h4>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="account-main container p-5">
        <?php
        // Display signup success message if set
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div class="profile-card p-5 container-fluid d-flex justify-content-between align-items-center">
            <section class="image-section">
                <img class="image-container img-fluid" src="../Resources/empty_photo.jpg" alt="You">
            </section>
            <section class="information-section">
                <?php
                // Fetch user details from the database
                $sql = "SELECT * FROM CUSTOMER WHERE cust_id = '$session_id'";
                $result = mysqli_query($conn, $sql);
                $account = mysqli_fetch_assoc($result);
                ?>

                <h1 class="text-white"><?php echo $account["fname"] . ' ' . $account["lname"]; ?></h1>
                <h3 class="text-white-50"><?php echo $account["email"]; ?></h3>
                <h4 class="text-white-50"><?php echo $account["cust_address"]; ?></h4>
                <h4 class="text-white-50"><?php echo $account["contact_number"]; ?></h4>

                <div class="button-container mt-3">
                    <!-- Edit Profile Button -->
                    <button type="button" class="edit-profile-button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit profile
                    </button>

                    <!-- Edit Profile Modal -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="container-fluid d-flex justify-content-center align-items-center">
                                        <section class="edit-user-input text-white">
                                            <h1 class="text-center">Edit Account</h1>
                                            <div class="d-flex align-items-center justify-content-center mt-5" style="gap: 5px 5px;">
                                                <input required type="text" class="display-input" placeholder="First Name" name="edit-fname" value="<?php echo $account['fname']; ?>">
                                                <input required type="text" class="display-input" placeholder="Last Name" name="edit-lname" value="<?php echo $account['lname']; ?>">
                                            </div>
                                            <span class="error"><?php echo $nameErr; ?></span><br>
                                            <input required type="email" class="display-input" placeholder="Email" name="edit-email" value="<?php echo $account['email']; ?>">
                                            <span class="error"><?php echo $emailErr; ?></span><br><br>
                                            <input type="password" class="display-password" placeholder="New Password" name="edit-password">
                                            <span class="error"><?php echo $passwordErr; ?></span><br><br>
                                            <input required type="text" class="display-input" placeholder="Address" name="edit-address" value="<?php echo $account['cust_address']; ?>">
                                            <span class="error"><?php echo $addressErr; ?></span><br><br>
                                            <input required type="number" class="display-input" placeholder="Contact Number" name="edit-number" value="<?php echo $account['contact_number']; ?>">
                                            <span class="error"><?php echo $numberErr; ?></span><br><br>
                                            <div class="button-container mt-3 d-flex align-items-center justify-content-center">
                                                <button type="submit" class="edit-profile-button" name="edit-profile">Confirm Edit</button>
                                            </div>
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order History Button -->
                    <button type="button" class="purchase-history-button" data-bs-toggle="modal" data-bs-target="#purchaseHistoryModal">
                        Order History
                    </button>

                    <!-- Order History Modal -->
                    <div class="modal fade" id="purchaseHistoryModal" tabindex="-1" aria-labelledby="purchaseHistoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content text-white">
                                <h1 class="text-center">Order History</h1>
                                <?php
                                // Fetch order history from the database
                                $sql = "SELECT prod_name, order_specs, quantity, total_payment, order_date, delivery_option, delivery_date FROM ORDERS
                                    JOIN PRODUCT ON ORDERS.prod_id = PRODUCT.prod_id
                                    WHERE cust_id = '$session_id'
                                    ORDER BY order_date DESC;";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <table class="table table-dark table-striped-columns table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Order Specifications</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total Payment</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Delivery Option</th>
                                            <th scope="col">Delivery Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $order['prod_name']; ?></td>
                                                <td><?php echo $order['order_specs']; ?></td>
                                                <td><?php echo $order['quantity']; ?></td>
                                                <td><?php echo $order['total_payment']; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                                <td><?php echo $order['delivery_option']; ?></td>
                                                <td><?php echo $order['delivery_date']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <a class="nav-item nav-link" href="../PHP/logout.php">
                        <button class="logout-button">Log Out</button>
                    </a>
                </div>
            </section>
        </div>
    </section>

</body>

</html>