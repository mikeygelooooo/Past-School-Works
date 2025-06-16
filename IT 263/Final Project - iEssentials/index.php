<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEssentials - Premium iPhone Accessories</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="Styles/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Favicon -->
    <link rel="icon" href="Resources/logo.png">
</head>

<body class="body-homepage d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);">
        <div class="container-fluid px-3">
            <a class="navbar-brand" href="index.php">
                <img class="nav-logo" src="Resources/logo.png" alt="iEssentials Logo">
                <span class="fs-3 fw-semibold align-middle">iEssentials</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="Pages/accessories.php">
                            <span class="fs-5 fw-medium px-2">Accessories</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION["cust_id"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Pages/shoppingcart.php">
                                <span class="fs-5 fw-medium px-2">Cart</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= isset($_SESSION["cust_id"]) ? 'Pages/account.php' : 'Pages/account-forms.php' ?>">
                            <span class="fs-5 fw-medium px-2">Account</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-homepage container-fluid p-3 text-white flex-grow-1 d-flex flex-column position-relative">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="content-wrapper flex-grow-1 d-flex flex-column justify-content-center align-items-center">
            <div class="header-text text-center">
                <div class="text-content">
                    <h1 class="fs-1 fw-semibold">Enhance Your iPhone Experience</h1>
                    <p class="display-3 fw-bold">Premium Accessories</p>
                    <p class="fs-5">Discover our exclusive collection of iPhone accessories designed to elevate functionality and style. From
                        sleek cases to innovative gadgets, we have everything you need to make your iPhone truly yours.</p>
                    <a href="Pages/accessories.php" class="btn btn-lg btn-light rounded-pill p-3 mt-3 fw-semibold">Explore Now</a>
                </div>
            </div>
        </div>

        <ul class="slides position-absolute top-0 start-0 w-100 h-100">
            <?php for ($i = 0; $i < 6; $i++) : ?>
                <li><span></span></li>
            <?php endfor; ?>
        </ul>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slides li');
            let currentSlide = 0;

            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }

            slides[0].classList.add('active');
            setInterval(nextSlide, 5000); // Change slide every 5 seconds
        });
    </script>
</body>

</html>