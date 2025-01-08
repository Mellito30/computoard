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
    // Recoger datos del formulario
    $nombre_usuario = $_POST['nombre'];
    $apellido_usuario = $_POST['apellido'];
    $rango = $_POST['rango'];
    $clave = $_POST['clave'];

    // Verificar si el nombre de usuario ya está registrado
    $sql = "SELECT * FROM formulario WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "¡Este nombre de usuario ya está registrado!";
    } else {
        // Cifrar la contraseña
        $clave_cifrada = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO formulario (nombre_usuario, apellido_usuario, rango, clave) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre_usuario, $apellido_usuario, $rango, $clave_cifrada);
        if ($stmt->execute()) {
            echo "¡Registro exitoso!";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
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
    <title>Document</title>
    <link rel="stylesheet" href="Sign-up-Administrador.css">
</head>
<body>     
    
    <div class="div-Formulario">
        <form class="Formulario" action="" method="POST" id="RegisterForm">

            <p class="Title-Sign_up">Sign up</p> <br>
            <div>
                <label class="Label-Sign_up" for="name" >Nombre del Usuario</label>
                <input class="Input-Sign_up" type="text" name="nombre"><br><br>
                
                <label class="Label-Sign_up" for="name" >Apellido del Usuario</label>
                <input class="Input-Sign_up" type="text" name="apellido"><br><br>
            
                <label class="Label-Sign_up" for="name">Rango del Usuario</label>
                <input class="Input-Sign_up" type="text" name="rango" ><br><br>
                
                <label class="Label-Sign_up" for="name">Contraseña</label>
                <input class="Input-Sign_up" type="password" name="clave"><br><br>
            </div>
            
           <button class="Button-Sign_up">Crear cuenta</button>

           <p class="Link-log">¿Ya tiene una cuenta? 
            <a class="Link" href="Login.php">Acceder</a>
        </p>
        </form>
    </div>
</body>
</html>