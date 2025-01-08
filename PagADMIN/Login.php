<?php
// Conexión con la base de datos
$servidor = "localhost";
$usuario = "root"; 
$contrasena = ""; 
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    // Consultar la base de datos para verificar el nombre de usuario
    $sql = "SELECT * FROM formulario WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El nombre de usuario existe, verificar la contraseña
        $row = $result->fetch_assoc();
        if (password_verify($clave, $row['clave'])) {
            // La contraseña es correcta, iniciar sesión
            echo "¡Bienvenido, " . $row['nombre_usuario'] . "!";
            // Aquí podrías guardar la sesión o redirigir a otra página
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
            header("Location: Index-Administrador.php");  // Redirigir al panel de usuario
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // El nombre de usuario no está registrado
        echo "El nombre de usuario no está registrado.";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login-Administrador.css">
</head>
<body>
    <div class="div-Formulario">
        <form class="Formulario" method="POST">
            <p class="Title-Log">Login</p> <br>
            <div>
                <label class="Label-Log" for="user">Nombre del Usuario</label>
                <input class="Input-Log" type="text" name="nombre_usuario" placeholder="Ingrese su Nombre" required><br><br>
                
                <label class="Label-Log" for="password">Contraseña</label>
                <input class="Input-Log" type="password"name="clave" placeholder="Ingrese su Contraseña" required><br><br>
            </div>
            
            <button class="Button-Log">Acceder</button>

            <p class="Link-Sign_up">
             ¿No tiene una cuenta? <a class="Link" href="Sign-up.php">Registrar</a>
            </p>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
