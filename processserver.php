<?php
// Connect to the database
$host = "database-1.cyj4ppjzlsat.us-east-2.rds.amazonaws.com";
$port = 5432;
$dbname = "postgres";
$user = "postgres";
$password = "postgres2023$";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Failed to connect to the database.";
    exit;
}

// Insert data into the database if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $zipcode = $_POST['zipcode'];
    $coins = $_POST['coins'];

    $sql = "INSERT INTO purchases (first_name, last_name, billing_zipcode, coins)
            VALUES ('$fname', '$lname', '$zipcode', '$coins')";
    $result = pg_query($conn, $sql);

    if (!$result) {
        echo "Failed to insert data into the database.";
        exit;
    }

    echo "Data inserted successfully.";

    header("Location: index.html");
}

// Close the database connection
pg_close($conn);
?>


