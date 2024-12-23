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
    $id = $_POST['id']; 
    $departamento = $_POST['nombre'];
    $tipodispositivo = $_POST['tipo'];
    $modelo = $_POST['marca'];
    $fechaingreso = $_POST['entradafecha'];
    $fechasalida = $_POST['salidafecha'];
    $estado = $_POST['estado'];

    
    if (empty($modelo)) {
        echo "Error: el campo modelo no está lleno.";
    } else {
        // Actualizar los datos en la base de datos
        $sql = "UPDATE dispositivos SET 
                departamento='$departamento', 
                tipo_dispositivo='$tipodispositivo', 
                modelo='$modelo', 
                fecha_ingreso='$fechaingreso', 
                fecha_salida='$fechasalida', 
                estado='$estado' 
                WHERE id='$id'"; 

        if ($conn->query($sql) === TRUE) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos: " . $conn->error;
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
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Formulariooo).css">
</head>
<body>
    
    <!-- Sección de Barra de navegación -->
    <section class="Sec-Nav">
        <nav class="div-Nav">
            <ul class="Barra-Nav">
                <li class="div-Sec">
                    <img class="Logo-ARM" src="img/LOGOARM.png" alt="LOGOARM">
                </li>
                <li class="div-Sec">
                    <a class="Link-Nav" href="Index-Administrador.php">Inicio</a><br>
                    <a class="Link-Nav" id="Button-active" href="Administrador(Formulario).php">Editar Dispositivo</a><br>
                    <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                    <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
                    <a href="Administrador(Cuenta).php">
                        <img class="Ico-Nav" src="img/Icono-perfil.png" alt="Icono-Perfil">
                    </a>
                </li>
            </ul>
        </nav>
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
                <label class="Label-formulario" for="id">ID del Dispositivo:</label>
                <input class="Input-Formulario" type="text" id="id" name="id" required><br><br>
            </div>

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
                <label class="Label-formulario" for="modelo">Modelo del dispositivo:</label>
                <input class="Input-Formulario" type="text" id="modelo" name="marca" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="entradafecha">Fecha de Ingreso:</label>
                <input class="Input-Formulario" type="date" id="entradafecha" name="entradafecha" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="salidafecha">Fecha de Salida:</label>
                <input class="Input-Formulario" type="date" id="salidafecha" name="salidafecha"><br><br>
            </div>

            <button class="Botton-formulario" type="submit">Actualizar</button>
        </form>
    </section>

</body>
</html>




