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

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; 
    $departamento = $_POST['nombre'];
    $tipodispositivo = $_POST['tipo'];
    $modelo = $_POST['marca'];
    $fechaingreso = $_POST['entradafecha'];
    $fechasalida = $_POST['salidafecha'];
    $estado = $_POST['estado'];

    // Verificar si las fechas están vacías y asignarles un valor por defecto o NULL
    if (empty($fechaingreso)) {
        $fechaingreso = NULL;
    } else {
        if (!DateTime::createFromFormat('Y-m-d', $fechaingreso)) {
            $mensaje = "Error: la fecha de ingreso no tiene un formato válido.";
            exit;
        }
    }

    if (empty($fechasalida)) {
        $fechasalida = NULL;
    } else {
        if (!DateTime::createFromFormat('Y-m-d', $fechasalida)) {
            $mensaje = "Error: la fecha de salida no tiene un formato válido.";
            exit;
        }
    }

    if (empty($id)) {
        $mensaje = "Error: el ID del dispositivo no está especificado.";
    } else {
        // Obtener los valores actuales desde la base de datos
        $query = "SELECT departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida, estado FROM dispositivos WHERE id = '$id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Si la fecha ingresada es NULL, se mantiene el valor anterior
            if (empty($fechaingreso)) {
                $fechaingreso = $row['fecha_ingreso'];
            }
            if (empty($fechasalida)) {
                $fechasalida = $row['fecha_salida'];
            }

            // Compara si realmente hay un cambio en los datos
            $cambioDepartamento = ($row['departamento'] != $departamento);
            $cambioTipo = ($row['tipo_dispositivo'] != $tipodispositivo);
            $cambioModelo = ($row['modelo'] != $modelo);
            $cambioFechaIngreso = ($row['fecha_ingreso'] != $fechaingreso);
            $cambioFechaSalida = ($row['fecha_salida'] != $fechasalida);
            $cambioEstado = ($row['estado'] != $estado);

            // Si no hubo ningún cambio en los valores, no hacemos nada
            if (!$cambioDepartamento && !$cambioTipo && !$cambioModelo && !$cambioFechaIngreso && !$cambioFechaSalida && !$cambioEstado) {
                $mensaje = "No se realizaron cambios.";
            } else {
                // Si hay cambios, proceder con la actualización
                // La consulta asegura que las fechas vacías sean enviadas como NULL si se proporciona una nueva fecha
                $sql = "UPDATE dispositivos SET 
                        departamento='$departamento', 
                        tipo_dispositivo='$tipodispositivo', 
                        modelo='$modelo', 
                        fecha_ingreso=" . ($fechaingreso ? "'$fechaingreso'" : "fecha_ingreso") . ", 
                        fecha_salida=" . ($fechasalida ? "'$fechasalida'" : "fecha_salida") . ", 
                        estado='$estado' 
                        WHERE id='$id'"; 

                if ($conn->query($sql) === TRUE) {
                    $mensaje = "Datos actualizados correctamente.";
                } else {
                    $mensaje = "Error al actualizar los datos: " . $conn->error;
                }
            }
        } else {
            $mensaje = "Dispositivo no encontrado.";
        }
    }
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

    <title>Administrado de Usuarios</title>
    <link rel="stylesheet" href="CSS/Pag-Administrador-(Formulariooo).css">
    <?php include 'Modals/modal.php'; ?>
    <link rel="stylesheet" href="Modals/modalstyle.css">
    <script src="Modals/modal.js"></script>
    <div id="php-mensaje" style="display: none;"><?php echo $mensaje; ?></div>
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

            <!-- Detalles del perfil (siempre visibles) -->
            <div id="profileContainer" class="profile-container">
                <div class="profile-details">
                    <img class="profile-img-small" src="img/Icono-perfil.png" alt="Icono-Perfil">
                    <div class="profile-info">
                    <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre_usuario']; ?></p> <!-- Sustituir por datos dinámicos -->
                    <p><strong>Rango:</strong> <?php echo  $_SESSION['rango']; ?></p>
                    </div>
                </div>
                <button class="btn-logout"><a href="logout.php">Cerrar sesión</a></button>
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
                <label class="Label-formulario" for="id">ID del Dispositivo:</label>
                <input class="Input-Formulario" type="text" id="id" name="id" required><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario">Estado:</label>
                <div class="Estados-formulario">
                    <input class="Input-Formulario" type="radio" id="reparado" name="estado" value="Reparado">
                    <label class="Estado-opciones" for="reparado">Reparado</label><br>

                    <input class="Input-Formulario" type="radio" id="en_proceso" name="estado" value="En Proceso">
                    <label class="Estado-opciones" for="en_proceso">En Proceso</label><br>

                    <input class="Input-Formulario" type="radio" id="sin_iniciar" name="estado" value="Sin Iniciar">
                    <label class="Estado-opciones" for="sin_iniciar">Sin Iniciar</label><br>
                </div><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="nombre">Nombre del Departamento:</label>
                <input class="Input-Formulario" type="text" id="nombre" name="nombre"><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="tipo">Tipo de dispositivo:</label>
                <input class="Input-Formulario" type="text" id="tipo" name="tipo"><br><br>
            </div>    

            <div class="div-formulario">
                <label class="Label-formulario" for="modelo">Modelo del dispositivo:</label>
                <input class="Input-Formulario" type="text" id="modelo" name="marca"><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="entradafecha">Fecha de Ingreso:</label>
                <input class="Input-Formulario" type="date" id="entradafecha" name="entradafecha"><br><br>
            </div>

            <div class="div-formulario">
                <label class="Label-formulario" for="salidafecha">Fecha de Salida:</label>
                <input class="Input-Formulario" type="date" id="salidafecha" name="salidafecha"><br><br>
            </div>

            <button class="Botton-formulario" type="submit">Actualizar</button>
        </form>
    </section>


    <script src="Administrador-(Dispositivos).js"> </script>
    <script src="Administrador-(Cuenta).js"></script>
    <script src="Modal.js"></script>


<!-- Modal de notificación -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modal-message">Mensaje de notificación</h2>
        <button class="btn-aceptar" onclick="closeModal()">Aceptar</button>
    </div>
</div>


</body>
</html>




