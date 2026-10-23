<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Поля не заповнені']);
        exit;
    }

    if (!isset($_SESSION['users_array']) || empty($_SESSION['users_array'])) {
        echo json_encode(['error' => 'Ніхто не зареєструвався']);
        exit;
    }

    $isLoginSuccessful = false;

    foreach ($_SESSION['users_array'] as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $isLoginSuccessful = true;
            break;
        }
    }

    if ($isLoginSuccessful) {
        echo json_encode(['success' => true, 'message' => 'Вхід виконано!']);
    } else {
        echo json_encode(['error' => 'Неправильна пошта або пароль!']);
    }
}
?>