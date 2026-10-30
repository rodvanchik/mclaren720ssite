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

    $stmt = $conn->prepare("INSERT INTO contact (name, contact_type, contact_email_or_other, type_of_message, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $how_to_contact, $contact_option, $type_of_contact, $other_details);


    if ($stmt->execute()) {
        echo json_encode(['message' => 'Дані успішно надіслано.']);
    } else {
        echo json_encode(['error' => 'Не вдалося надіслати дані.']);
    }

    $stmt->close();
    $conn->close();
}

?>