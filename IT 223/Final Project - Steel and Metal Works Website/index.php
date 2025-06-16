<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- icon -->
    <link rel="icon" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="d-inline">
    <!-- Navigation Bar -->
    <nav class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="Resources/logo.png" alt="Shop Logo" style="height: 65px;">
            </a>
            <ul class="navbar-nav justify-content-end">
                <a class="nav-link mx-3" href="Pages/products.php">
                    <h4>Products</h4>
                </a>
                <?php
                session_start();

                if (isset($_SESSION["cust_id"])) {
                    echo '<a class="nav-link mx-3" href="Pages/cart.php"><h4>Cart</h4></a>';
                    echo '<a class="nav-link mx-3" href="Pages/account.php"><h4>Account</h4></a>';
                } else {
                    echo '<a class="nav-link mx-3" href="Pages/login.php"><h4>Log-In</h4></a>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <main class="container-fluid mt-5">
        <?php
        // Signup success message
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . htmlspecialchars($msg) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <div class="container d-flex justify-content-center align-items-center p-5 mt-5">
            <div class="container p-5 text-white border border-info w-50 rounded-3 bg-transparent vh-50 ms-5 mt-5">
                <h1>Quality of customized steel furniture, such as bed frames, gates, tables, chairs, etc. (est. 2023)</h1>
                <a href="Pages/products.php">
                    <button class="btn btn-info mt-3">
                        <h5>View our Products <i class="bi bi-box-arrow-up-right"></i></h5>
                    </button>
                </a>
            </div>
        </div>
    </main>
</body>

</html>