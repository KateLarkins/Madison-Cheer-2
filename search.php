<?php
$host = 'localhost'; // Replace with your database host
$username = ''; // Replace with your database username
$password = ''; // Replace with your database password
$database = ''; // Replace with your database name

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die('Could not connect to the database: ' . mysqli_connect_error());
}

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

    // Query to search for the term in the database
    $query = "SELECT * FROM search_values WHERE value LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error executing the query: ' . mysqli_error($conn));
    }

    // Display the search results
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['value'] . '<br>';
    }

    mysqli_close($conn);
}
?>