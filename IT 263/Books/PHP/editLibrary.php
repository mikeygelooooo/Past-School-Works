<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manga_id = filter_input(INPUT_POST, "mangaId", FILTER_SANITIZE_NUMBER_INT);
    $manga_title = filter_input(INPUT_POST, "mangaTitle", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_author = filter_input(INPUT_POST, "mangaAuthor", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_year = filter_input(INPUT_POST, "mangaYear", FILTER_SANITIZE_NUMBER_INT);
    $manga_genre = filter_input(INPUT_POST, "mangaGenre", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_publication = filter_input(INPUT_POST, "mangaPublication", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_reading = filter_input(INPUT_POST, "mangaReading", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "UPDATE MANGA SET 
                    manga_title = '$manga_title',
                    manga_author = '$manga_author',
                    manga_year = '$manga_year',
                    manga_genre = '$manga_genre',
                    manga_publication = '$manga_publication',
                    manga_reading = '$manga_reading'
                WHERE manga_id = '$manga_id'";

    $result = mysqli_query($conn, $sql);

    // Redirect to products page if the order was successful
    if ($result) {
        header("Location: ../index.php?msg=Manga edited successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
