<?php
include "PHP/database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mihon</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <nav class="navbar navbar-dark bg-dark text-white">
        <div class="container-fluid p-3">
            <a class="navbar-brand" href="index.php">
                <img class="nav-logo" src="Resources/logo.png" alt="Logo">
                <span class="display-6 fw-bold font-monospace align-middle">Mihon</span>
            </a>

            <button type="button" class="btn btn-secondary btn-lg fw-bold font-monospace" data-bs-toggle="modal" data-bs-target="#addManga">
                <i class="fa-solid fa-book-bookmark"></i>
                Add Manga
            </button>
        </div>
    </nav>
    <main class="intro container-fluid p-5">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 600px">
            <table class="table table-dark table-hover mb-0">
                <thead style="background-color: #393939;">
                    <tr class="text-uppercase text-success">
                        <th class="text-center align-middle">Title</th>
                        <th class="text-center align-middle">Author</th>
                        <th class="text-center align-middle">Genre</th>
                        <th class="text-center align-middle">Serialization</th>
                        <th class="text-center align-middle">Reading Status</th>
                        <th class="text-center align-middle">Rating</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM MANGA ORDER BY title";
                    $result = mysqli_query($connection, $query);

                    while ($manga = mysqli_fetch_assoc($result)) :
                        $manga_id = $manga["id"];
                    ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo $manga['title'] ?></td>
                            <td class="text-center align-middle"><?php echo $manga['author'] ?></td>
                            <td class="text-center align-middle"><?php echo $manga['genre'] ?></td>
                            <td class="text-center align-middle"><?php echo $manga['serialization'] ?></td>
                            <td class="text-center align-middle"><?php echo $manga['reading'] ?></td>
                            <td class="text-center align-middle"><?php echo $manga['rating'] ?>/10</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-light btn-lg d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#editManga<?php echo $manga_id ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <?php include "Includes/editManga.php" ?>

                                    <button type="button" class="btn btn-outline-light btn-lg d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteManga<?php echo $manga_id ?>">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    <?php include "Includes/deleteManga.php" ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php include "Includes/addManga.php" ?>
    </main>

</body>

</html>