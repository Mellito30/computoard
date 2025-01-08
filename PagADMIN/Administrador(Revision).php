<?php

// Conexion con la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas otro usuario
$contrasena = ""; // Cambia esto si tienes contraseña
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener registros de la tabla solicitudes
$sql = "SELECT id, nombre_solicitante, correo_electronico, rango_solicitante, nombre_departamento, asunto, descripcion_solicitud, fecha FROM solicitudes";
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
    <div class="div-Nav">
        <ul class="Barra-Nav">
            <li class="div-Sec">
                <img class="Logo-ARM" src="img/logoarm.png" alt="LOGOARM">
            </li>
            <li class="div-Sec">
                <a class="Link-Nav" href="Index-Administrador.php">Inicio</a><br>
                <a class="Link-Nav" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                <a class="Link-Nav" id="Button-active" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
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
                            <button id="Buttonaceptar_<?php echo $row['id']; ?>" class="Buttom-solicitud aceptar" data-id="<?php echo $row['id']; ?>" data-email="<?php echo $row['correo_electronico']; ?>" data-nombre="<?php echo htmlspecialchars($row['nombre_solicitante']); ?>">Aceptar</button>
                            
                            <!-- Contenedor del cuadro emergente (Modal) -->
                            <div id="formularioModal_<?php echo $row['id']; ?>" class="modal oculto">
                                <div class="modal-contenido">
                                    <h2 class="tittle-modal">Información de la Solicitud</h2>
                                    <label for="nombreUsuario">Nombre del Usuario:</label>
                                    <input class="input-modal" type="text" id="nombreUsuario_<?php echo $row['id']; ?>" value="" readonly>
                                    
                                    <label for="comentarios">Comentario:</label>
                                    <textarea class="input-modal" id="comentarios_<?php echo $row['id']; ?>" placeholder="Escribe un comentario"></textarea>
                                    
                                    <div class="botones">
                                        <button class="botones-finale" id="guardar_<?php echo $row['id']; ?>">Enviar Comentario</button>
                                        <button class="botones-finale" id="cancelar_<?php echo $row['id']; ?>">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
    <div class="solicitud-Fecha"><?php echo date("d M", strtotime($row['fecha'])); ?></div>
</div>


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

<script src="Administrador (Cuenta).js"></script>
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



