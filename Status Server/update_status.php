<?php


$conn = new mysqli("localhost", "root", "", "status_test");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!";
}

$result = $conn->query("SELECT estado FROM estado WHERE id = 1");
$row = $result->fetch_assoc();
$nuevo_estado = ($row['estado'] === 'Reparado') ? 'En Reparación' : 'Reparado';


$conn->query("UPDATE estado SET estado = '$nuevo_estado' WHERE id = 1");


echo json_encode(['estado' => $nuevo_estado]);

$conn->close();
?>
