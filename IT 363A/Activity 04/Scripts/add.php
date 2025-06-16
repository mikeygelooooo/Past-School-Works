<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_type = filter_input(INPUT_POST, "report_type", FILTER_SANITIZE_SPECIAL_CHARS);
    $reporter_name = filter_input(INPUT_POST, "reporter_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $reporter_contact = filter_input(INPUT_POST, "reporter_contact", FILTER_SANITIZE_SPECIAL_CHARS);
    $item_name = filter_input(INPUT_POST, "item_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $item_description = filter_input(INPUT_POST, "item_description", FILTER_SANITIZE_SPECIAL_CHARS);
    $date_event = filter_input(INPUT_POST, "date_event", FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, "location", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($report_type == "found") {
        $current_location = filter_input(INPUT_POST, "current_location", FILTER_SANITIZE_SPECIAL_CHARS);
        $owner_verification = filter_input(INPUT_POST, "owner_verification", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO REPORTS (report_type, reporter_name, reporter_contact, item_name, item_description, date_event, location, current_location, owner_verification)
                VALUES ('$report_type', '$reporter_name', '$reporter_contact', '$item_name', '$item_description', '$date_event', '$location', '$current_location', '$owner_verification')";
    } else {
        $sql = "INSERT INTO REPORTS (report_type, reporter_name, reporter_contact, item_name, item_description, date_event, location)
                VALUES ('$report_type', '$reporter_name', '$reporter_contact', '$item_name', '$item_description', '$date_event', '$location')";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../index.php?msg=Report added successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
