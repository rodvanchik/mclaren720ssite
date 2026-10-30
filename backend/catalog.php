<?php

session_start();

header('Content-Type: application/json; charset=utf-8');
require 'database.php';

$stmt = $conn->prepare("SELECT car_id, car_name, car_image, car_specs FROM catalog");
$stmt->execute();
$result = $stmt->get_result();

$cars = [];

while ($row = $result->fetch_assoc()) {
    $row['car_specs'] = json_decode($row['car_specs'], true);
    
    $cars[] = $row;
}
echo json_encode($cars);

$stmt->close();
$conn->close();

?>