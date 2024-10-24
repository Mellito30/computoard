<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Estado Actual</h1>
    <p id="estadoActual">Cargando...</p>

    <script>
        function actualizarEstado() {
            fetch('fetch_status.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('estadoActual').textContent = `Estado: ${data.estado}`;
                });
        }

        window.onload = actualizarEstado;
    </script>
</body>
</html>
