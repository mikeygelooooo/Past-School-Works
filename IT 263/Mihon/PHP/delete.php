<?php
include "database.php";

$manga_id = $_GET["manga-id"];
$query = "DELETE FROM MANGA WHERE id = '$manga_id'";
$result = mysqli_query($connection, $query);

if ($result) {
    header("Location: ../index.php?msg=Manga removed successfully");
} else {
    echo "Failed: " . mysqli_error($connection);
}
?>