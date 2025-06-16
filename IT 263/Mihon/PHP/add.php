<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, "add-title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "add-author", FILTER_SANITIZE_SPECIAL_CHARS);
    $genre = filter_input(INPUT_POST, "add-genre", FILTER_SANITIZE_SPECIAL_CHARS);
    $serializtion = filter_input(INPUT_POST, "add-serialization", FILTER_SANITIZE_SPECIAL_CHARS);
    $reading = filter_input(INPUT_POST, "add-reading", FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, "add-rating", FILTER_SANITIZE_NUMBER_INT);

    $query = "INSERT INTO MANGA (title, author, genre, serialization, reading, rating)
	            VALUES ('$title', '$author', '$genre', '$serializtion', '$reading', '$rating')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: ../index.php?msg=Manga added successfully");
    } else {
        echo "Failed: " . mysqli_error($connection);
    }
}
?>