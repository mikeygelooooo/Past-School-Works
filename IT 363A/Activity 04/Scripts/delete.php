<?php
include "database.php";

$report_id = $_GET["report_id"];

$sql = "DELETE FROM REPORTS WHERE report_id = '$report_id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: ../index.php?msg=Report deleted successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>