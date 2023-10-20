<?php
// Include the database connection file
include('conn.php');
if(isset($_POST['submit'])){
// Get the reset token and new password from the form
$token = $_POST['token'];
$new_password = $_POST['new_password'];

// Verify the reset token in the database
$token_query = "SELECT email, timestamp FROM reset_password WHERE token = ?";
$token_stmt = $connect->prepare($token_query);
$token_stmt->bind_param("s", $token);
$token_stmt->execute();
$token_result = $token_stmt->get_result();

if ($token_result->num_rows === 1) {
    $token_row = $token_result->fetch_assoc();
    
    // Check if the token has expired (e.g., within a certain time frame)
    $timestamp = $token_row['timestamp'];
    $current_time = time();
    $token_validity_period = 3600; // 1 hour in seconds (adjust as needed)

    if (($current_time - $timestamp) <= $token_validity_period) {
        // Token is valid; update the user's password
        $email = $token_row['email'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $update_query = "UPDATE registration SET password = ? WHERE email = ?";
        $update_stmt = $connect->prepare($update_query);
        $update_stmt->bind_param("ss", $hashed_password, $email);
        
        if ($update_stmt->execute()) {
            // Password updated successfully
            echo "Password updated successfully.";
            
            // Remove the used reset token from the database
            $delete_query = "DELETE FROM password_reset WHERE token = ?";
            $delete_stmt = $connect->prepare($delete_query);
            $delete_stmt->bind_param("s", $token);
            $delete_stmt->execute();
        } else {
            echo "Error updating password: " . $connect->error;
        }
    } else {
        echo "Token has expired. Please request a new password reset.";
    }
    $token_stmt->close();
$update_stmt->close();
} else {
    echo "Invalid or expired token.";
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
<h2>Reset Password</h2>
    <form action="login.php" method="post">
        <label for="token">Reset Token:</label>
        <input type="text" name="token" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br><br>
        
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>