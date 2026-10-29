<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mclarensite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Помилка підключення до бази даних: ' . $conn->connect_error]));
};