<?php
// Include database connection and login validation scripts
include "../PHP/database.php";
include "../PHP/validate_login.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL query to fetch customer details based on the email
    $sql = "SELECT cust_id, email, cust_password, contact_number FROM CUSTOMER WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if the submit button was clicked
    if ($submit) {
        // Verify the password
        if (!password_verify($password, $row["cust_password"])) {
            $passwordErr = "Password incorrect";
        } else {
            // Start a new session and store customer detailsF
            session_start();
            $_SESSION["cust_id"] = $row["cust_id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["number"] = $row["contact_number"];

            // Redirect to the home page with a success message
            header("Location: ../index.php?msg=Logged in successfully");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
                <li class="nav-item">
                    <a class="nav-link mx-3" href="products.php">
                        <h4>Products</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="signup.php">
                        <h4>Sign-Up</h4>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Log-in Page -->
    <section class="login-form container-fluid">
        <?php
        // Display signup success message if present
        if (isset($_GET["msg"])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . htmlspecialchars($_GET["msg"]) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <!-- Log-in Main -->
        <div class="container p-5 h-100 d-flex align-items-center justify-content-center">
            <section class="login-container">
                <!-- Log-in form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <p class="login-text">Log-in</p>
                    <section class="user-input">
                        <!-- Email input -->
                        <input required type="email" class="display-input" placeholder="Email" name="login-email">
                        <!-- Email error -->
                        <span class="error"><?php echo $emailErr; ?></span><br><br>

                        <!-- Password input -->
                        <input required type="password" class="display-password" placeholder="Password" name="login-password">
                        <!-- Password error -->
                        <span class="error"><?php echo $passwordErr; ?></span><br><br>
                    </section>

                    <!-- Link to signup page -->
                    Don't have an account yet? <a href="signup.php">Sign-up</a>
                    <br><br>

                    <!-- Submit login -->
                    <button type="submit" class="login-button" name="login">Log-in</button>
                </form>
            </section>
        </div>
    </section>
</body>
</html>
