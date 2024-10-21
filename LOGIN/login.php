<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <form class="formulario" onsubmit="return validateForm()">
            <h2>Administracion</h2>
            <label for="name">Usuario:</label>
            <input type="text" id="user" name="user">
            <label for="email">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

<script>

function validateForm() {
    const user = document.getElementById("user").value;
    const validUser = "Administracion";
    const password = document.getElementById("password").value;
    const validPassword = "@ARD2024";

    if (user === validUser && password === validPassword) {
        sessionStorage.setItem("isLoggedIn", "true");       
        window.location.href = "principal.php";
        return false;
    } else {
        alert("La clave o usuario es incorrecto. Intenta de nuevo.");
        return false;
    }
}
</script>