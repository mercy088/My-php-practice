<?php
include('conn.php');
if (isset($_POST['submit'])) {
    // Get user input
    $userOrEmail = $_POST['user'];
    $password = $_POST['password'];

    // Check if the user exists (using email or username)
    $query = "SELECT * FROM registration WHERE (binary user = ? OR binary email = ?)";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "ss", $userOrEmail, $userOrEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // User exists, fetch user data
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct
            //session_start();
           // $_SESSION['id'] = $id;
            // Check for output buffering
             //header("location: dashboard.php");
            //exit();
            if(mysqli_num_rows($result) > 0)
            {
              setcookie("oka", $id, time()+3600);
              header("location: dashboard.php");
            }
        } else {
            // Incorrect password
            echo "Wrong password.";
        }
    } else {
        // User does not exist
        echo "User not found.";
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login php</title>
</head>
<body>
  <form action="" method="post">
    <fieldset>
      <legend>Register Here</legend>
      <input name="user" type="text" placeholder="email">
      <input name="password" type="password" placeholder="password">
      <input type="submit" value="Submit" name="submit">

    </fieldset>
  </form>
</body>
</html>