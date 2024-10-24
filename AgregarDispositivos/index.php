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
        <label for="nombre">Estado:</label>
        <input type="text" id="Estado" name="Estado" required><br><br>

        <label for="tipo">Equipo:</label>
        <input type="text" id="Equipo" name="Equipo" required><br><br>

        <label for="marca">Departamento:</label>
        <input type="text" id="Departamento" name="Departamento" required><br><br>

        <label for="marca">Fecha de Entrada:</label>
        <input type="date" id="fechaentrada" name="fechaentrada" required><br><br>

        <label for="marca">Fecha de Salida:</label>
        <input type="date" id="fechasalida" name="fechasalida"><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
