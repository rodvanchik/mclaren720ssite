<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mclarensite";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->query($sql);

    $sql = "CREATE TABLE catalog (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    car_id INT,
    car_name VARCHAR(32),
    car_image VARCHAR(255),
    car_specs JSON,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $conn->query($sql);
} catch(Exception $e) {
    echo $e->getMessage();
}

?>