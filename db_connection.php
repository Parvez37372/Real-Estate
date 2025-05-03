<?php
$hostName = "localhost"; 
$dbUser = "root";
$dbPassword = ""; // Empty string instead of space
$dbName = "webteidy_mahirealty";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
if (mysqli_num_rows($table_check) == 0) {
    die("Table 'users' does not exist in the database.");
}

// Optional: Message if everything is successful
echo "Database connected and 'users' table exists.";
?>
