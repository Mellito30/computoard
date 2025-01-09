<?php
session_start();  // Iniciar la sesión

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigimos al login
    header("Location: login.php");
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
                <a class="Link-Nav" id="Button-active" href="Index-Administrador.php">Inicio</a><br>
                <a class="Link-Nav" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
            </li>

            <!-- Detalles del perfil (siempre visibles) -->
            <div id="profileContainer" class="profile-container">
                <div class="profile-details">
                    <img class="profile-img-small" src="img/Icono-perfil.png" alt="Icono-Perfil">
                    <div class="profile-info">
                        <p><strong>Nombre:</strong> Juan Pérez</p> <!-- Sustituir por datos dinámicos -->
                        <p><strong>Rango:</strong> Administrador</p>
                    </div>
                </div>
                <button class="btn-logout" onclick="logout()">Cerrar Sesión</button>
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


