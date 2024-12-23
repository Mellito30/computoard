<?php
session_start();

$validUser = "Administracion";
$validPassword = "@ARD2024";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if ($user === $validUser && $password === $validPassword) {
        header("Location: principal.php"); 
        exit();
    } else {
        $error = "La clave o usuario es incorrecto. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login Administrador .css">
</head>
<body>
    <div class="div-Formulario">
        <form class="Formulario" method="POST">
            <p class="Title-Log">Login</p> <br>
            <div>
                <label class="Label-Log" for="user">Nombre del Usuario</label>
                <input class="Input-Log" type="text" id="user" name="user" placeholder="Ingrese su Nombre" required><br><br>
                
                <label class="Label-Log" for="password">Contraseña</label>
                <input class="Input-Log" type="password" id="password" name="password" placeholder="Ingrese su Contraseña" required><br><br>
            </div>
            
            <button class="Button-Log">Acceder</button>

            <p class="Link-Sign_up">
             ¿No tiene una cuenta? <a class="Link" href="Sign up.html">Registrar</a>
            </p>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

<!-- <script>

    function IniciarSesion() {
        const user = document.getElementById("user").value;
        const validUser = "Administracion";
        const password = document.getElementById("password").value;
        const validPassword = "@ARD2024";

        if (user === validUser && password === validPassword) {
            sessionStorage.setItem("EstaLogueado", "true");       
            window.location.href = "principal.php";
            return false;
        } else {
            alert("La clave o usuario es incorrecto. Intenta de nuevo.");
            return false;
        }
    }
</script> -->

