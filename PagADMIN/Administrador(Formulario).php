<?php

//conexion con la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas otro usuario
$contrasena = ""; // Cambia esto si tienes contraseña
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $departamento = $_POST['nombre'];
    $tipodispositivo = $_POST['tipo'];
    $modelo = $_POST['marca'];
    $fechaingreso = $_POST['entradafecha'];
    $fechasalida = $_POST['salidafecha'];

    //Ingresar los datos a la db
    $sql = "INSERT INTO dispositivos (departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida) 
            VALUES ('$departamento', '$tipodispositivo', '$modelo', '$fechaingreso', '$fechasalida')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
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
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Formulariooo).css">

</head>
<body>
    
  <!-- Sección de Barra de navegación -->
  <section class="Sec-Nav">
    </nav class="div-Nav">
        <ul class="Barra-Nav">
            <li class="div-Sec">
                    <img class="Logo-ARM" src="LOGOARM.png" alt="LOGOARM">
            </li>
            <li class="div-Sec">
                <a class="Link-Nav" href="Index-Administrador.php">Inicio</a><br>
                <a class="Link-Nav" id="Button-active" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
                <a href="Administrador(Cuenta).php">
                  <img class="Ico-Nav" src="img/Icono-perfil.png" alt="Icono-Perfil" href="#">
                </a>            
            </li>
        </ul>
    </nav>
</section>
  
        <!-- Sección de encabezado -->
    <section class="Header">

        <div class="div-Button">
            <a href="Administrador(Formulario).php" class="Button">Añadir</a>
            <a href="#" class="Button">Modificar</a>
            <a href="#" class="Button">Actualizar</a>
        </div>

    </section>
    <!-- Sección de formulario -->
    <section class="Sec-Body1">
        <form action="" method="POST">

             <div class="div-formulario">
                <label class="Label-formulario" for="marca">Estado:</label>
                      <div class="Estados-formulario">
                        <input class="Input-Formulario" type="radio" id="marca" name="marca" required><br><br>
                        <label for="Reparado">Reparado</label><br>
                        <input class="Input-Formulario" type="radio" id="marca" name="marca" required><br><br>
                        <label for="En Proceso">En Proceso</label><br>
                        <input class="Input-Formulario" type="radio" id="marca" name="marca" required><br><br>
                        <label for="Sin Iniciar">Sin Iniciar</label><br>
                    </div>  <br>
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
                <label class="Label-formulario" for="marca">Fecha de Ingreso:</label>
                <input class="Input-Formulario" type="date" id="entradafecha" name="entradafecha" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="marca">Fecha de Salida:</label>
                <input class="Input-Formulario" type="date" id="salidafecha" name="salidafecha"><br><br>
            </div>

            <button class="Botton-formulario" type="submit">Registrar</button>
        </form>
    </section>

</body>
</html>

<!-- <script>
        // Verificar si el usuario está logueado
        const EstaLogueado = sessionStorage.getItem("EstaLogueado");

        if (EstaLogueado !== "true") {
            // Si no está logueado, redirigir al login
            window.location.href = "login.php";
        }
    </script> -->

