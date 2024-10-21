<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>

    <h1>Bienvenido a la Página Principal</h1>
    <p>Has accedido correctamente después de loguearte.</p>

    <script>
        // Verificar si el usuario está logueado
        const isLoggedIn = sessionStorage.getItem("isLoggedIn");

        if (isLoggedIn !== "true") {
            // Si no está logueado, redirigir al login
            window.location.href = "login.php";
        }
    </script>

</body>
</html>
