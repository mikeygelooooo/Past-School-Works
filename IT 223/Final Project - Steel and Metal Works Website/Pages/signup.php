<?php
include "../PHP/database.php";
include "../PHP/validate_signup.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($submit)) {
    $sql = "INSERT INTO CUSTOMER (email, cust_password, fname, lname, cust_address, contact_number) 
            VALUES ('$email', '$password_hash', '$fname', '$lname', '$address', '$number')";

    $result = mysqli_query($conn, $sql);

    // Redirect to login page on success
    if ($result) {
        header("Location: login.php?msg=Account created successfully");
        exit;
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
    <title>Sign-up</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
                    <a class="nav-link mx-3" href="login.php">
                        <h4>Log-In</h4>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sign-up Page -->
    <section class="container p-5 mt-3 h-100 d-flex align-items-center justify-content-center">
        <div class="signup-container w-50">
            <!-- Sign-up Form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <p class="signup-text">Sign-up</p>

                <section class="user-input">
                    <!-- Name Input -->
                    <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                        <input required type="text" class="display-input" placeholder="First Name" name="signup-fname">
                        <input required type="text" class="display-input" placeholder="Last Name" name="signup-lname">
                    </div>
                    <!-- Name Error -->
                    <span class="error"><?php echo $nameErr; ?></span><br>

                    <!-- Email Input -->
                    <input required type="email" class="display-input" placeholder="Email" name="signup-email">
                    <!-- Email Error -->
                    <span class="error"><?php echo $emailErr; ?></span><br><br>

                    <!-- Password Input -->
                    <input required type="password" class="display-password" placeholder="Password" name="signup-password">
                    <!-- Password Error -->
                    <span class="error"><?php echo $passwordErr; ?></span><br><br>

                    <!-- Address Input -->
                    <input required type="text" class="display-input" placeholder="Address" name="signup-address">
                    <!-- Address Error -->
                    <span class="error"><?php echo $addressErr; ?></span><br><br>

                    <!-- Contact Number Input -->
                    <input required type="text" class="display-input" placeholder="Contact Number" name="signup-number">
                    <!-- Number Error -->
                    <span class="error"><?php echo $numberErr; ?></span><br><br>
                </section>

                <!-- Link to Login Page -->
                Already have an account? <a href="login.php">Log-in</a><br><br>

                <!-- Submit Button -->
                <button type="submit" class="signup-button" name="signup">Sign-up</button>
            </form>
        </div>
    </section>
</body>

</html>