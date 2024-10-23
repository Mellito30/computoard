<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="principal.css">
</head>
<body>
    <section class="header">
         <h1>Administracion de Dispositivos</h1>
    </section>

    <section class="add-devices">
        <h1>Registrar Dispositivo</h1>
        <form action="guardar.php" method="POST">
            <label for="nombre">Nombre del dispositivo:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="tipo">Tipo de dispositivo:</label>
            <input type="text" id="tipo" name="tipo" required><br><br>

            <label for="marca">Modelo:</label>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="marca">Descripcion del Problema:</label>
            <input type="text" id="notas" name="notas" required><br><br>
            
            <label for="marca">Fecha de Ingreso:</label>
            <input type="date" id="entradafecha" name="entradafecha" required><br><br>
            
            <label for="marca">Fecha de Salida:</label>
            <input type="date" id="salidafecha" name="salidafecha" required><br><br>

            <button type="submit">Registrar</button>
        </form>
    </section>

</body>
</html>

<script>
        // Verificar si el usuario está logueado
        const EstaLogueado = sessionStorage.getItem("EstaLogueado");

        if (EstaLogueado !== "true") {
            // Si no está logueado, redirigir al login
            window.location.href = "login.php";
        }
    </script>