<?php
include("conn.php");
if (isset($_COOKIE["oka"]))$user=$_COOKIE["oka"];else header("location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Welcome to my dashboard <?php echo $user?></h1>
  <a href="changepassword.php"> change password</a>
</body>
</html>