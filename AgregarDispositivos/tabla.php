<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "dispositivos_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todos los dispositivos
$sql = "SELECT * FROM dispositivos";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Dispositivos</title>
    <link rel="stylesheet" href="tabla.css">
</head>
<body>
    <h1>Lista de Dispositivos Registrados</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Equipo</th>
                <th>Departamento</th>
                <th>Fecha de Entrada</th>
                <th>Fecha de Salida</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Mostrar cada fila de la tabla
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['ID'] . "</td>
                            <td>" . $row['Estado'] . "</td>
                            <td>" . $row['Equipo'] . "</td>
                            <td>" . $row['Departamento'] . "</td>
                            <td>" . $row['Fecha_Entrada'] . "</td>
                            <td>" . $row['Fecha_Salida'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay dispositivos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
