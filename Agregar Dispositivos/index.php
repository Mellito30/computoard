<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Dispositivos</title>
</head>
<body>
    <h1>Registrar Dispositivo</h1>
    <form action="guardar.php" method="POST">
        <label for="nombre">Nombre del dispositivo:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="tipo">Tipo de dispositivo:</label>
        <input type="text" id="tipo" name="tipo" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
