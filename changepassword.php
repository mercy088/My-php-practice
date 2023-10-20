<?php
// Include the database connection file
include('conn.php');
if (!isset($_COOKIE['oka'])) {
    header("Location: login.php");
    exit();
}

// Get the user's username from the session
$user_id = $_COOKIE['oka'];
if (isset($_POST['submit'])) {
    // Get the old and new passwords from the form
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Validate the old password
    $query = "SELECT password FROM registration WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (password_verify($old_password, $row['password'])) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_query = "UPDATE registration SET password = ? WHERE id = ?";
        $update_stmt = $connect->prepare($update_query);
        $update_stmt->bind_param("ss", $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $connect->error;
        }

        // Close prepared statements
        $stmt->close();
        $update_stmt->close();
    } else {
        echo "Incorrect old password.";
    }
}

// Close the database connection
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
<h2>Change Password</h2>
    <form action="changepassword.php" method="post">
        <label for="old_password">Old Password:</label>
        <input type="password" name="old_password" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br><br>
        
        <input type="submit" value="Change Password" name="submit">
    </form>
</body>
</html>