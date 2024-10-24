<?php


$conn = new mysqli("localhost", "root", "", "status_test");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!";
}


$result = $conn->query("SELECT estado FROM estado WHERE id = 1");
$row = $result->fetch_assoc();


echo json_encode(['estado' => $row['estado']]);

$conn->close();
?>
