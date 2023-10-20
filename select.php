<?php include ('conn.php');?>
<?php


$query = "SELECT * FROM tableName";
$result = mysqli_query($connect, $query);

if ($result) {
  // echo '<table>';
  // echo '<tr>
  //           <th>ID</th>
  //           <th>Name</th>
  //       </tr>';
  // while ($row = mysqli_fetch_assoc($result)) {
  //     echo '<tr>';
  //     echo '<td>' . $row['id'] . '</td>';
  //     echo '<td>' . $row['name'] . '</td>';
  //     echo '</tr>';
  // }
  // echo '</table>';
  echo <<<ECO
  <table>
  <tr>
  <th>ID</th>
  <th>Name</th></tr>
  while ($row = mysqli_fetch_assoc($result)) {
    <tr>;
        <td>. $row[id] . </td>;
        <td> . $row[name] . </td>;
       </tr>;

  }
  </table>
  
  ECO;
    mysqli_free_result($result);
} else {
    echo 'Query error: ' . mysqli_error($connect);
}

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>
    <div>
      <?php


$query = "SELECT * FROM tableName";
$result = mysqli_query($connect, $query);

if ($result) {
  // echo '<table>';
  // echo '<tr>
  //           <th>ID</th>
  //           <th>Name</th>
  //       </tr>';
  // while ($row = mysqli_fetch_assoc($result)) {
  //     echo '<tr>';
  //     echo '<td>' . $row['id'] . '</td>';
  //     echo '<td>' . $row['name'] . '</td>';
  //     echo '</tr>';
  // }
  // echo '</table>';
  echo <<<ECO
  <table>
  <tr>
  <th>ID</th>
  <th>Name</th></tr>
  while ($row = mysqli_fetch_assoc($result)) {
    <tr>;
        <td>. $row[id] . </td>;
        <td> . $row[name] . </td>;
       </tr>;

  }
  </table>
  
  ECO;
    mysqli_free_result($result);
} else {
    echo 'Query error: ' . mysqli_error($connect);
}

mysqli_close($connect);
?>
    </div>
  </div>
</body>
</html>