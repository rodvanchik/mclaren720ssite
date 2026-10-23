<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Не всі поля заповнені!']);
        exit;
    }

    if (!isset($_SESSION['users_array'])) {
        $_SESSION['users_array'] = [];
    }

    $newId = count($_SESSION['users_array']) + 1;

    $_SESSION['users_array'][] = [
        'id'       => $newId,
        'email'    => $email,
        'phone'    => $phone,
        'password' => $password,
        'time'     => date('Y-m-d H:i:s')
    ];

    echo json_encode(['success' => true, 'message' => 'Реєстрація успішна!']);
}
?>