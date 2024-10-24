<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "dispositivos_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$Estado = $_POST['Estado'];
$Equipo = $_POST['Equipo'];
$Departamento = $_POST['Departamento'];
$fechaentrada = $_POST['fechaentrada'];
$fechasalida = $_POST['fechasalida'];

// Insertar datos en la base de datos
$sql = "INSERT INTO dispositivos (Estado, Equipo, Departamento, Fecha_Entrada, Fecha_Salida) VALUES ('$Estado', '$Equipo', '$Departamento', '$fechasalida', '$fechaentrada')";

if ($conexion->query($sql) === TRUE) {
    echo "Dispositivo registrado correctamente.";
    // Redirigir a la página de la tabla
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
