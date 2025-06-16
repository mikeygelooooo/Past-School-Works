<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manga_title = filter_input(INPUT_POST, "mangaTitle", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_author = filter_input(INPUT_POST, "mangaAuthor", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_year = filter_input(INPUT_POST, "mangaYear", FILTER_SANITIZE_NUMBER_INT);
    $manga_genre = filter_input(INPUT_POST, "mangaGenre", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_publication = filter_input(INPUT_POST, "mangaPublication", FILTER_SANITIZE_SPECIAL_CHARS);
    $manga_reading = filter_input(INPUT_POST, "mangaReading", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "INSERT INTO MANGA (manga_title, manga_author, manga_year, manga_genre, manga_publication, manga_reading)
	            VALUES ('$manga_title', '$manga_author', '$manga_year', '$manga_genre', '$manga_publication', '$manga_reading')";

    $result = mysqli_query($conn, $sql);

    // Redirect to products page if the order was successful
    if ($result) {
        header("Location: ../index.php?msg=Manga added successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
