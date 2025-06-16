<?php
require_once "../PHP/database.php";

session_start();

$session_id = $_SESSION["cust_id"] ?? null;
$session_password = $_SESSION["cust_password"] ?? null;

// Redirect if user is not logged in
if (!$session_id || !$session_password) {
    header("Location: account-forms.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEssentials Account Center</title>

    <link rel="stylesheet" href="../Styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../Resources/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .account-tabs {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        #main-container {
            transition: height 0.3s ease;
        }

        #main-container.fixed-height {
            height: calc(100vh - 100px);
            /* Adjust 100px based on your navbar height */
        }

        #history {
            max-height: calc(85vh - 200px);
            /* Adjust 200px based on your navbar height and tab height */
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-photo">
    <?php include "../Includes/navbar.php" ?>

    <main id="main-container" class="container-fluid p-3 p-sm-5">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <section class="account-tabs container-fluid text-white bg-dark rounded p-5">
            <!-- Nav tabs -->
            <ul class="nav nav-underline justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-white" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                        <span class="fs-5">Profile</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                        <span class="fs-5">Order History</span>
                    </button>
                </li>
            </ul>

            <!-- Tab panes -->
            <section class="tab-content">
                <?php
                include "../Includes/profile.php";
                include "../Includes/order-history.php";
                ?>
            </section>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainContainer = document.getElementById('main-container');
            const profileTab = document.getElementById('profile-tab');
            const historyTab = document.getElementById('history-tab');

            function adjustContainerHeight() {
                mainContainer.classList.toggle('fixed-height', historyTab.classList.contains('active'));
            }

            profileTab.addEventListener('shown.bs.tab', adjustContainerHeight);
            historyTab.addEventListener('shown.bs.tab', adjustContainerHeight);

            // Initial adjustment
            adjustContainerHeight();
        });
    </script>
</body>

</html>