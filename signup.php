<?php include ('conn.php');
// Function to validate input
function validateInput($data) {
  // Remove leading and trailing whitespace
  $data = trim($data);
  // Remove backslashes
  $data = stripslashes($data);
  // Convert special characters to HTML entities to prevent XSS attacks
  $data = htmlspecialchars($data);
  return $data;
}


?>
<?php
// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = validateInput($_POST["user"]);
  $email = validateInput($_POST["email"]);
  $phone_no = validateInput(($_POST["phone"]));
  $password = validateInput($_POST["password"]);

      // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Insert data into the database using prepared statements
      $query = "INSERT INTO registration(user, email, phone_no, password) VALUES (?, ?, ?, ?)";
    
      $stmt = mysqli_prepare($connect, $query);
  
      mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $phone_no, $hashedPassword);
      if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful!";
        header("Location:signup.php"); // Redirect to a success page
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    

   

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Document</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>Register Here</legend>
      <input name="user" type="text" placeholder="username">
      <input name="email" type="text" placeholder="email">
      <input name="phone" type="tel" placeholder="phone">
      <input name="password" type="password" placeholder="password">
      <input type="submit" value="Submit" name="submit">

    </fieldset>
  </form>
</body>
</html>