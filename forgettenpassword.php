<?php
// Include the database connection file
include('conn.php');
error_reporting(E_ALL);

if(isset($_POST['submit'])){
// Get the user's email from the form
$email = $_POST['email'];

// Verify if the user exists in the database
$user_query = "SELECT id FROM registration WHERE email = ?";
$user_stmt = $connect->prepare($user_query);
$user_stmt->bind_param("s", $email);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows === 1) {
    // User exists; proceed with sending the reset token

    // Generate a unique reset token
    $reset_token = bin2hex(random_bytes(32));

    // Get the current timestamp
    $timestamp = time();

    // Insert the reset token and timestamp into the database
    $insert_query = "INSERT INTO reset_password (email, token, timestamp) VALUES (?, ?, ?)";
    $insert_stmt = $connect->prepare($insert_query);
    $insert_stmt->bind_param("sss", $email, $reset_token, $timestamp);

    if ($insert_stmt->execute()) {
       ini_set("SMTP", "localhost"); // Use "localhost" as the SMTP server
       ini_set("smtp_server", "smtp.gmail.com");
ini_set("smtp_port", "25"); // Use the default SMTP port

        // Send a password reset email to the user
        $reset_link = "localhost:3000/resetpassword.php?token=$reset_token";
        $to = $email;
        $subject = "Password Reset";
        $message = "To reset your password, click the following link: $reset_link";
        $headers = "From: pleagueupdate@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Password reset email sent. Check your inbox.";
        } else {
            echo "Error sending password reset email.";
        }
    } else {
        echo "Error inserting reset token into the database: " . $connect->error;
    }
    $user_stmt->close();
} else {
    echo "User with the provided email does not exist.";
}


}
$connect->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h2>Forgot Password</h2>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        
        <input type="submit" name="submit">
    </form>
</body>
</html>