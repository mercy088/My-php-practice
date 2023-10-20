<?php
include('conn.php');



if (isset($_POST['submit'])) {
    $searchTerm = mysqli_real_escape_string($connect, $_POST['searchTerm']); 
    // Sanitize input

    // Execute a SELECT query with a WHERE clause to search for data
    $query = "SELECT * FROM blog WHERE title LIKE ?";
    $stmt = mysqli_prepare($connect, $query);
    $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for partial matching
    mysqli_stmt_bind_param($stmt, "s", $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<h2>Search Results:</h2>';
            echo '<ul>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li>' . $row['column_to_display'] . '</li>'; // Adjust the column name to display
            }
            echo '</ul>';
        } else {
            echo 'No results found.';
        }
        mysqli_free_result($result);
    } else {
        echo 'Query error: ' . mysqli_error($connect);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
</head>
<body>
    <h1>Search for Data</h1>
    <form method="post" action="search.php">
        <label for="searchTerm">Search Term:</label>
        <input type="text" id="searchTerm" name="searchTerm">
        <button type="submit" name="submit">Search</button>
    </form>
</body>
</html>
