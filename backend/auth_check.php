<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$is_logged = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

echo json_encode([
    'logged_in' => $is_logged,
    'is_admin' => $is_admin
]);
?>