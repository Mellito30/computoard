<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "dispositivos_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$marca = $_POST['marca'];
$notas = $_POST['notas'];
$entradafecha = $_POST['entradafecha'];
$salidafecha = $_POST['salidafecha'];

// Insertar datos en la base de datos
$sql = "INSERT INTO dispositivos (nombre, tipo, marca, notas, entradafecha, salidafecha) VALUES ('$nombre', '$tipo', '$marca'), '$notas', '$entradafecha', '$salidafecha'";

if ($conexion->query($sql) === TRUE) {
    echo "Dispositivo registrado correctamente.";
    // Redirigir a la página de la tabla
    header("Location: tabla.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
