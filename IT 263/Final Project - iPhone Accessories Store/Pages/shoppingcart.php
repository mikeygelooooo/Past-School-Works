<?php
require_once "../PHP/database.php";

session_start();

// Ensure user is logged in
if (!isset($_SESSION["cust_id"])) {
    header("Location: account-forms.php");
    exit();
}

$session_id = $_SESSION["cust_id"];

// Prepare the cart query
$query = "SELECT Cart.*, Accessories.*, Models.model_name, Colors.color_name 
          FROM Cart
          JOIN Accessories ON Cart.acs = Accessories.acs_id
          LEFT JOIN Models ON Cart.model = Models.model_id
          LEFT JOIN Colors ON Cart.color = Colors.color_id
          WHERE cust = ?
          ORDER BY cart_id DESC";

$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $session_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEssentials - Your Cart</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../Styles/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Favicon -->
    <link rel="icon" href="../Resources/logo.png">
</head>

<body class="bg-secondary">
    <?php include "../Includes/navbar.php" ?>

    <main class="container p-5">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php include "../Includes/display-cart.php"; ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>