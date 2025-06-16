<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'iEssentials');

// Create a new mysqli object and establish the database connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set the character set to UTF-8 (optional, but recommended)
if (!$connection->set_charset("utf8")) {
    die("Error setting character set: " . $connection->error);
}
