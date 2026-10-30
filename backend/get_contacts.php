<?php
header('Content-Type: application/json');
require 'database.php';

$stmt = $conn->prepare("SELECT * FROM contact");
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['success' => true, 'messages' => $messages]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to retrieve messages']);
}

?>