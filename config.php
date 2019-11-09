<?php

$conn = mysqli_connect("127.0.0.1", "root", "Ple01010!@#", "db_green_shop");
mysqli_query($conn, "SET NAMES UTF8");
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$dsn = 'mysql:dbname=db_green_shop;host=127.0.0.1';
$user = 'root';
$password = 'Ple01010!@#';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>