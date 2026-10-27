<?php

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

try {
    $sql = "SELECT * FROM catalog";

    $cars = $conn->query($sql);

    foreach($cars as $car) {
        $car['car-specs'] = json_encode($car['car-specs'], true);

        $car['id'] = car['car-id'];
    }

    echo json_encode($cars);
}
catch(Exception $e) {
    echo json_encode(['error' => 'Помилка підключення']);
}

?>