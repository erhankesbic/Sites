<?php
//Database connection details
$servername = "localhost";
$username = "erhan";
$password = "13022029";
$dbname = "sg_db";

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}