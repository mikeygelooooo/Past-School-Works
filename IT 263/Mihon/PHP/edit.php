<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id =  filter_input(INPUT_POST, "edit-id", FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, "edit-title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "edit-author", FILTER_SANITIZE_SPECIAL_CHARS);
    $genre = filter_input(INPUT_POST, "edit-genre", FILTER_SANITIZE_SPECIAL_CHARS);
    $serialization = filter_input(INPUT_POST, "edit-serialization", FILTER_SANITIZE_SPECIAL_CHARS);
    $reading = filter_input(INPUT_POST, "edit-reading", FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, "edit-rating", FILTER_SANITIZE_NUMBER_INT);

    
    $query = "UPDATE MANGA SET
                title = '$title',
                author = '$author',
                genre = '$genre',
                serialization = '$serialization',
                reading = '$reading',
                rating = '$rating'
            WHERE id = '$id'";

    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: ../index.php?msg=Manga edited successfully");
    } else {
        echo "Failed: " . mysqli_error($connection);
    }
}
?>