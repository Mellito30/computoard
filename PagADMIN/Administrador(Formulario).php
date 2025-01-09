<?php
session_start(); // Inicia la sesión

// Verificamos si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Si no está logueado, redirigimos a la página de login
    header("Location: Login.php");
    exit();
}
?>

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departamento = $_POST['nombre'];
    $tipodispositivo = $_POST['tipo'];
    $modelo = $_POST['marca']; 
    $fechaingreso = $_POST['entradafecha'];
    $fechasalida = $_POST['salidafecha'];
    $estado = $_POST['estado']; 

    if (empty($modelo)) {
        echo "Error: el campo modelo no está lleno.";
    } else {
        // Ingresar los datos a la base de datos
        $sql = "INSERT INTO dispositivos (departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida, estado) 
                VALUES ('$departamento', '$tipodispositivo', '$modelo', '$fechaingreso', '$fechasalida', '$estado')";

        if ($conn->query($sql) === TRUE) {
            echo "Datos guardados correctamente.";
        } else {
            echo "Error al guardar los datos: " . $conn->error;
        }
    }

    // Redirigir para evitar reenvío de datos al recargar
    header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=" . urlencode($mensaje));
    exit;
}

// Mostrar mensaje si está presente en la URL
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv=”Expires” content=”0″>
    
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Formulariooo).css">
</head>
<body>
    
    <!-- Sección de Barra de navegación -->
    <section class="Sec-Nav">
    <div class="div-Nav">
        <ul class="Barra-Nav">
            <li class="div-Sec">
                <img class="Logo-ARM" src="img/logoarm.png" alt="LOGOARM">
            </li>
            <li class="div-Sec">
                <a class="Link-Nav" href="Index-Administrador.php">Inicio</a><br>
                <a class="Link-Nav" id="Button-active" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
            </li>
            <!-- Imagen del perfil en la parte inferior -->
            <div id="profileContainer" class="profile-container">                
                <svg class="Ico-Nav" src="img/Icono-perfil.png" alt="Icono-Perfil" onclick="toggleProfileDetails()"
                stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 496 512" height="200px" width="200px" 
                xmlns="http://www.w3.org/2000/svg"><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 
                96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 
                55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 
                0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path></svg>
            </div>           
        </ul>
    </div>
</section>
  
    <!-- Sección de encabezado -->
    <section class="Header">
        <div class="Contenido1">
            <p class="Textcontanido1">m.</p>
        </div>
    </section>
    
    <!-- Sección de formulario -->
    <section class="Sec-Body1">
        <form action="" method="POST">

            <div class="div-formulario">
                <label class="Label-formulario">Estado:</label>
                <div class="Estados-formulario">
                    <input class="Input-Formulario" type="radio" id="reparado" name="estado" value="Reparado" required>
                    <label class="Estado-opciones" for="reparado">Reparado</label><br>

                    <input class="Input-Formulario" type="radio" id="en_proceso" name="estado" value="En Proceso" required>
                    <label class="Estado-opciones" for="en_proceso">En Proceso</label><br>

                    <input class="Input-Formulario" type="radio" id="sin_iniciar" name="estado" value="Sin Iniciar" required>
                    <label class="Estado-opciones" for="sin_iniciar">Sin Iniciar</label><br>
                </div><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="nombre">Nombre del Departamento:</label>
                <input class="Input-Formulario" type="text" id="nombre" name="nombre" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="tipo">Tipo de dispositivo:</label>
                <input class="Input-Formulario" type="text" id="tipo" name="tipo" required><br><br>
            </div>    

            <div class="div-formulario">
                <label class="Label-formulario" for="entradafecha">Fecha de Ingreso:</label>
                <input class="Input-Formulario" type="date" id="entradafecha" name="entradafecha" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="salidafecha">Fecha de Salida:</label>
                <input class="Input-Formulario" type="date" id="salidafecha" name="salidafecha"><br><br>
            </div>

            <button class="Botton-formulario" type="submit">Registrar</button>
        </form>
    </section>

<script src="Administrador-(Cuenta).js"></script>


</body>
</html>


