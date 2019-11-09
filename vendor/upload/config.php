<?php // เชื่อมต่อฐานข้อมูล Bill
$host = "localhost";
$username = "root";
$password = "12345678";
$db = "greenbox_dlt";

//คำสั่ง Connect ฐานข้อมูล
$conn = new mysqli($host, $username, $password, $db);
mysqli_query($conn, "SET NAMES UTF8");

// check connection
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} ?>