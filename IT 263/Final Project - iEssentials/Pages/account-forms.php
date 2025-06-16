<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access your iEssentials Account</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../Styles/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Favicon -->
    <link rel="icon" href="../Resources/logo.png">

    <style>
        .account-form {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            max-width: 75vh;
        }

        .nav-pills .nav-item {
            flex: 1;
        }

        .nav-pills .nav-item button {
            width: 100%;
        }
    </style>
</head>

<body class="bg-photo">
    <?php include "../Includes/navbar.php" ?>

    <main class="container p-3">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <section class="account-form container-sm text-white bg-dark rounded p-5">
            <nav>
                <ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist" style="gap: 5px 5px;">
                    <li class="nav-item" role="presentation">
                        <button class="btn btn-lg btn-outline-secondary active fw-medium" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">LOG-IN</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="btn btn-lg btn-outline-secondary fw-medium" id="pills-signup-tab" data-bs-toggle="pill" data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup" aria-selected="false">SIGN-UP</button>
                    </li>
                </ul>
            </nav>

            <div class="tab-content" id="pills-tabContent">
                <?php
                include "../Includes/login-form.php";
                include "../Includes/signup-form.php";
                ?>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>