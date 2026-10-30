<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $how_to_contact = $_POST['contactMethod'] ?? '';
    $contact_option = $_POST['contactOption'] ?? '';
    $type_of_contact = $_POST['contactType'] ?? '';
    $other_details = $_POST['otherDetails'] ?? '';
    $user_id = $_SESSION['user_id'] ?? 0;
    if($user_id == 0 && $type_of_contact != "account") {
        echo json_encode(['error' => 'Ви не увійшли у систему']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO contact (name, user_id, contact_type, contact_email_or_other, type_of_message, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $user_id, $how_to_contact, $contact_option, $type_of_contact, $other_details);


    if ($stmt->execute()) {
        echo json_encode(['message' => 'Дані успішно надіслано.']);
    } else {
        echo json_encode(['error' => 'Не вдалося надіслати дані.']);
    }

    $stmt->close();
    $conn->close();
}

?>