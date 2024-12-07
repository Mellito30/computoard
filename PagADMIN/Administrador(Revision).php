<?php
//conexion con la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas otro usuario
$contrasena = ""; // Cambia esto si tienes contraseña
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todas las solicitudes
$sql = "SELECT * FROM solicitudes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Revision).css">
</head>
<body>
    
    <!-- Sección de Barra de navegación -->
    <section class="Sec-Nav">
    </nav class="div-Nav">
        <ul class="Barra-Nav">
            <li class="div-Sec">
                    <img class="Logo-ARM" src="img/LOGOARM.png" alt="LOGOARM">
            </li>
            <li class="div-Sec">
                <a class="Link-Nav" href="Index-Administrador.php">Inicio</a><br>
                <a class="Link-Nav" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                <a class="Link-Nav" id="Button-active" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
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
            <a href="#" class="Button">Eliminar</a>
            <a href="#" class="Button">Actualizar</a>
        </div>

</section>

<!-- Sección de solicitud -->
<section class="Sec-Body1">
    <div class="div-solicitudes">
        <div class="header">
            <h1>Bandeja de Entrada</h1>
        </div>

        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Recorrer todas las solicitudes y mostrarlas
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="marco-solicitud">
                    <span class="star" data-starred="false">★</span>
                    <div class="solicitud-detalles">
                        <div class="nombre-y-rango">
                            <span class="Solicitud-usuario">Nombre del Guardia: <?php echo htmlspecialchars($row['nombre_solicitante']); ?></span>
                            <span class="solicitud-rango">(Rango: <?php echo htmlspecialchars($row['rango_solicitante']); ?>)</span>
                        </div>
                        <div class="solicitud-asunto destacado">Asunto: <?php echo htmlspecialchars($row['asunto']); ?></div>
                    </div>
                    <div class="solicitud-departamento">Departamento: <?php echo htmlspecialchars($row['nombre_departamento']); ?></div>
                    <div class="solicitud-detalle expandible">
                        Descripción del problema: <?php echo nl2br(htmlspecialchars($row['descripcion_solicitud'])); ?>
                    </div>
                    <div class="solicitud-info">
                        <button class="Buttom-solicitud">Aceptar</button>
                        <div class="solicitud-Fecha"><?php echo date("d M", strtotime($row['fecha'])); ?></div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No hay solicitudes";
        }
        ?>

    </div>
</section>

<?php
// Cerrar la conexión
$conn->close();
?>

<script src="Pag Administrador (Revision).js"></script>
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



