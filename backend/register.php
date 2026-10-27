<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mclarensite";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
}
catch(Exception $e) {
    echo "Connection failed" , $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Будь ласка, заповніть пошту та пароль!']);
        exit;
    }

    $exe = $conn->prepare("INSERT INTO users (email, phone_number, password) VALUES (?, ?, ?)");

    $exe->bind_param("sss", $email, $phone, $password);

    if ($exe->execute()) {
        echo json_encode(['success' => true, 'message' => 'Реєстрація успішна!']);
    } else {
        echo json_encode(['error' => 'Помилка: Користувач з такою поштою або телефоном вже існує.']);
    }

    $exe->close();
    $conn->close();
}


/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}*/


?>