<?php include ('conn.php');?>

<?php
$tableName = "registration";
$query = "CREATE TABLE IF NOT EXISTS $tableName (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    user VARCHAR(255) NOT NULL,
    password VARCHAR(255)   NOT NULL,
    phone_no  VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($connect, $query)) {
    echo "Table '$tableName' created successfully";
} else {
    die("Error creating table: " . mysqli_error($connect));
}
$tableName2 = "reset_password";
$query = "CREATE TABLE IF NOT EXISTS $tableName2 (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    timestamp varchar(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($connect, $query)) {
    echo "Table '$tableName2' created successfully";
} else {
    die("Error creating table: " . mysqli_error($connect));
}


// Close the connection
mysqli_close($connect);
?>