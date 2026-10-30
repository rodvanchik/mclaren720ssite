<?php

session_start();
header('Content-Type: application/json; charset=utf-8');

$isLogged = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

echo json_encode(['isLogged' => $isLogged, 'is_admin' => $isAdmin]);

?>