<?php
// Create a connection
$connect = mysqli_connect("localhost", "root", "");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the database
$databaseName = "traininddb";
$query = "CREATE DATABASE IF NOT EXISTS $databaseName";

if (mysqli_query($connect, $query)) {
    echo "Database created successfully";
} else {
    die("Error creating database: " . mysqli_error($connect));
}


?>