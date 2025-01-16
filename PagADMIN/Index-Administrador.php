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

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los datos de la tabla "dispositivos"
$sql = "SELECT estado, departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida FROM dispositivos";
$result = $conn->query($sql);

// Manejo de errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">

    <meta http-equiv=”Expires” content=”0″>
    <meta http-equiv=”Cache-Control” content=”no-cache, mustrevalidate”>


    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="CSS/Pag-Administradorrr.css">
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
                        <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre_usuario'];?></p> <!-- Sustituir por datos dinámicos -->
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

    <!-- Sección de cuerpo principal -->
    <section class="Sec-Body1">

        <!-- Recuadro 1: Solicitudes aceptadas -->
        <div class="Recuadros-superiores">
    <div class="recuadro Solicitudes">
    <div class="Title-header">
                    Recordatorio de Solicitudes
    </div>
        <!-- Contenedor de recordatorios -->
        <div class="contenedor-recordatorios">

            <div class="recordatorio">
                <div class="encabezado">
                    <div class="nombre-rango">
                        <span class="nombre">Comandante JCK</span>
                        <span class="rango">(Capitán Navío)</span>
                    </div>
                    <!-- <div class="fecha-aceptada">
                        Aceptado: <span>06/12</span>
                    </div> -->
                </div>
                <div class="detalles">
                    <span class="departamento">Cómputo</span>
                    <span class="asunto">Asunto:</span>
                    <span class="fecha-solicitada">Solicitado: <span>05/12</span></span>
                </div>
            </div>            
            
        </div>
    </div>                                 
            

            <!-- Recuadro 2: Formulario de ingreso -->
            <div class="recuadro formulario">
            <div class="Title-header">
                Formulario de Ingreso           
             </div>
                    <form action="#" method="post">
                    <label for="dispositivo">Dispositivo:</label>
                    <input type="text" id="dispositivo" name="dispositivo">
                    <button type="submit">Ingresar</button>
                </form>
            </div>

        </div> 

        <!-- Recuadro 3: Lista de dispositivos recientes -->
        <div class="recuadro dispositivos">
                        <!-- Sección de dispositivos -->
                <!-- Sección de títulos -->
                <div class="div-Lista-Dispositivos">
                <div class="Title-header-Dispositivos">
                    Revisión de Dispositivos
                </div>
                <!-- Títulos de las columnas -->
                <div class="div-titulos-dispositivos">
                    <p class="Text-info-Titulos">Estado</p>
                    <p class="Text-info-Titulos">Equipo</p>
                    <p class="Text-info-Titulos">Departamento</p>
                    <p class="Text-info-Titulos">Fecha de Entrada</p>
                    <p class="Text-info-Titulos">Fecha de Salida</p>
                </div>

                <!-- Información de los dispositivos -->
                <?php if ($result->num_rows > 0): ?>
                    <?php 
                    $is_black = false; // Alternancia de colores para las filas
                    while ($row = $result->fetch_assoc()): 
                    ?>
                        <div class="<?php echo $is_black ? 'div-Info-dispo-BGBLACK' : 'div-Info-Dispositivos'; ?>">
                            <p class="Text-info-Dispositivos"><?php echo $row['estado']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['modelo']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['departamento']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['fecha_ingreso']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['fecha_salida']; ?></p>
                        </div>
                        <?php $is_black = !$is_black; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="div-Info-Dispositivos">
                        <p class="Text-info-Dispositivos">No hay dispositivos registrados.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="Administrador-(Cuenta).js"></script>
    
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