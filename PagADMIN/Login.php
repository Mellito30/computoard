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
session_start();  // Iniciar la sesión para usar las variables de sesión

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    // Consulta a la base de datos para obtener el usuario
    $sql = "SELECT * FROM formulario WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['user_id'] = $row['id'];  // Almacenamos el ID del usuario
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];  // Almacenamos el nombre de usuario
            $_SESSION['rango'] = $row['rango'];  // Almacenamos el rango si es necesario
            header("Location: Index-Administrador.php"); 
            exit(); // Aseguramos que no se ejecute código posterior
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "El nombre de usuario no está registrado.";
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
    <title>Inicio de Sesión </title>
    <link rel="stylesheet" href="CSS/Login-Administrador.css">
    <?php include 'Modals/modal.php'; ?>
    <link rel="stylesheet" href="Modals/modalstyle.css">
    <script src="Modals/modal.js"></script>
    <div id="php-mensaje" style="display: none;"><?php echo $mensaje; ?></div>
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
