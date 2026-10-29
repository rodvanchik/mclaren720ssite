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
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Введіть пошту та пароль!']);
        exit;
    }

    $check = $conn->prepare("SELECT id, password, is_admin FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();

    $result = $check->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
            if($row['is_admin'] == 1) {
                echo json_encode(['success' => true, 'is_admin' => $is_admin, 'message' => 'Вхід як адміна успішно виконано!']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Вхід успішно виконано!']);
            }
        } else {
            echo json_encode(['error' => 'Неправильний пароль!']);
        }
    } else {
        echo json_encode(['error' => 'Користувача з такою поштою не знайдено!']);
    }

    $check->close();
    $conn->close();
}
/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}*/
?>