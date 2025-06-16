<?php
session_start();

$session_id = isset($_SESSION["cust_id"]) ? $_SESSION["cust_id"] : null;

require_once "../PHP/database.php";

/**
 * Display accessories based on the given filter
 *
 * @param int $filter The category filter (0 for all categories)
 * @return void
 */
function displayAccessories(int $filter): void
{
    global $connection;

    $query = "SELECT * FROM Accessories";
    $params = [];

    if ($filter !== 0) {
        $query .= " WHERE acs_category = ?";
        $params[] = $filter;
    }

    $stmt = mysqli_prepare($connection, $query);

    if ($params) {
        mysqli_stmt_bind_param($stmt, "i", ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($accessory = mysqli_fetch_assoc($result)) {
            $accessory_id = $accessory["acs_id"];
            include '../Includes/display-accessories.php';
        }
    } else {
        echo "<p class='text-center'>No accessories found in this category.</p>";
    }

    mysqli_stmt_close($stmt);
}

$categories = [
    ["id" => "accessories", "name" => "All Accessories", "icon" => "stars", "filter" => 0],
    ["id" => "cases", "name" => "Cases & Protection", "icon" => "phone-fill", "filter" => 1],
    ["id" => "charging", "name" => "Charging Essentials", "icon" => "lightning-charge-fill", "filter" => 2],
    ["id" => "headphones", "name" => "Headphones", "icon" => "earbuds", "filter" => 3]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop for iPhone Accessories</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../Styles/style.css">

    <style>
        .card {
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 4px 10px 0 rgba(0, 0, 0, 0.19);
        }
    </style>

    <!-- JavaScript -->
    <script src="../JavaScript/script.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Icon -->
    <link rel="icon" href="../Resources/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include "../Includes/navbar.php" ?>

    <main class="container p-3 p-lg-5">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <p class="fs-1 fw-bold text-center">Find the accessories that you're looking for.</p>
        <hr class="border-black border-2">
        <p class="fs-2 fw-semibold text-center mb-5">Browse by Category</p>

        <!-- Category Navigation -->
        <div class="container">
            <ul class="nav nav-pills d-flex justify-content-center flex-wrap text-center" id="pills-tab" role="tablist">
                <?php foreach ($categories as $index => $category) : ?>
                    <li class="nav-item col-6 col-md-3" role="presentation">
                        <button class="btn btn-outline-dark <?= $index === 0 ? 'active' : '' ?> rounded-circle p-4" id="pills-<?= $category['id'] ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $category['id'] ?>" type="button" role="tab">
                            <i class="bi bi-<?= $category['icon'] ?> display-4"></i>
                        </button>
                        <p class="fw-semibold mt-3"><?= $category['name'] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <hr class="border-black border-2">

        <!-- Accessories Display -->
        <div class="tab-content container p-3" id="pills-tabContent">
            <?php foreach ($categories as $index => $category) : ?>
                <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" id="pills-<?= $category['id'] ?>" role="tabpanel" tabindex="0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php displayAccessories($category['filter']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>