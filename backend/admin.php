<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['error' => 'У вас немає прав для виконання цієї дії!']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'] ?? '';
    $car_name = $_POST['car_name'] ?? '';
    $car_image = $_POST['car_image'] ?? '';
    $car_specs_string = $_POST['car_specs'] ?? '';

    if (empty($car_id) || empty($car_name)) {
        echo json_encode(['error' => 'Заповніть обов\'язкові поля (ID та Назву)!']);
        exit;
    }

    $specsArray = [];
    if (!empty($car_specs_string)) {
        $specsArray = explode(',', $car_specs_string);
        $specsArray = array_map('trim', $specsArray); 
    }
    
    $specsJson = json_encode($specsArray, JSON_UNESCAPED_UNICODE);

    $stmt = $conn->prepare("INSERT INTO catalog (car_id, car_name, car_image, car_specs) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $car_id, $car_name, $car_image, $specsJson);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Автомобіль успішно додано!']);
    } else {
        echo json_encode(['error' => 'Помилка: Можливо, авто з таким ID вже існує.']);
    }

    $stmt->close();
    $conn->close();
}
?>