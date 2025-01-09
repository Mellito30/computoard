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

// Procesar formulario del modal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre-usuario']) && isset($_POST['comentario'])) {
    $nombre_usuario = $conn->real_escape_string($_POST['nombre-usuario']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $solicitud_id = $conn->real_escape_string($_POST['solicitud-id']); // ID de la solicitud

    // Insertar datos en la tabla comentarios_solicitudes
    $sql_insert = "INSERT INTO comentarios_solicitudes (solicitud_id, nombre_usuario, comentario) 
                   VALUES ('$solicitud_id', '$nombre_usuario', '$comentario')";

    if ($conn->query($sql_insert)) {
        echo "<script>alert('Solicitud aceptada con éxito.');</script>";
    } else {
        echo "<script>alert('Error al procesar la solicitud: " . $conn->error . "');</script>";
    }
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
                    <a class="Link-Nav" id="Button-active" href="Index-Administrador.php">Inicio</a><br>
                    <a class="Link-Nav" href="Administrador(Formulario).php">Ingreso de Dispositivo</a><br>
                    <a class="Link-Nav" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
                    <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
                </li>
                <div id="profileContainer" class="profile-container">
                    <svg class="Ico-Nav" src="img/Icono-perfil.png" alt="Icono-Perfil" onclick="toggleProfileDetails()"
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 496 512" height="200px" width="200px" 
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 
                        96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 
                        55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 
                        0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                    </svg>
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

    <!-- Sección de solicitudes -->
    <section class="Sec-Body1">
        <div class="div-solicitudes">
            <div class="header">
                <h1>Bandeja de Entrada</h1>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="marco-solicitud">
                        <div class="star-container">
                            <span class="star" data-starred="false">★</span>
                        </div>
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
                            <button class="Buttom-solicitud" onclick="openModal(<?php echo $row['id']; ?>)">Aceptar</button>
                            <div class="solicitud-Fecha"><?php echo date("d M", strtotime($row['fecha'])); ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay solicitudes</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Modal -->
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <h2 class="Tittle-modal">Aceptar Solicitud</h2>
            <form id="modal-form" method="POST">
                <input type="hidden" id="solicitud-id" name="solicitud-id" value="">
                <label class="Label-modal" for="nombre-usuario">Nombre del usuario:</label>
                <input class="Input-modal" type="text" id="nombre-usuario" name="nombre-usuario" required>
                <label class="Label-modal" for="comentario">Comentario:</label>
                <textarea class="Input-modal" id="comentario" name="comentario" rows="4" required></textarea>
                <div class="modal-buttons">
                    <button type="button" class="modal-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="modal-accept">Aceptar</button>
                </div>
            </form>
        </div>
    </div>

    <?php $conn->close(); ?>

    <script src="Pag-Administrador-(Revision).js"></script>
    <script src="Administrador-(Cuenta).js"></script>

</body>
</html>
