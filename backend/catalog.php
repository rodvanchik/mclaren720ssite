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


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['error' => 'Немає прав']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'] ?? '';

    if (empty($car_id)) {
        echo json_encode(['error' => 'Немає ID']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM catalog WHERE car_id = ?");
    $stmt->bind_param("s", $car_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Видалено!']);
        exit;
    } else {
        echo json_encode(['error' => 'Помилка бази даних!']);
        exit;
    }
}

$stmt->close();
$conn->close();

?>