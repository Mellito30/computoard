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

// Parámetros de paginación
$records_per_page = 10; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$offset = ($page - 1) * $records_per_page; // Desplazamiento
$buttons_to_display = 5; // Máximo de botones visibles

// Consultar registros con límite y desplazamiento
$sql = "SELECT estado, departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida 
        FROM dispositivos 
        LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

// Manejo de errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Obtener el número total de registros
$total_sql = "SELECT COUNT(*) as total FROM dispositivos";
$total_result = $conn->query($total_sql);
$total_records = $total_result->fetch_assoc()['total'];

// Calcular el número total de páginas
$total_pages = ceil($total_records / $records_per_page);

// Calcular el rango de botones visibles
$start_page = max(1, $page - floor($buttons_to_display / 2));
$end_page = min($total_pages, $start_page + $buttons_to_display - 1);

// Ajustar el rango si hay menos páginas al inicio
if (($end_page - $start_page + 1) < $buttons_to_display) {
    $start_page = max(1, $end_page - $buttons_to_display + 1);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=”Cache-Control” content=”no-cache, mustrevalidate”>
    
    <meta http-equiv=”Cache-Control” content=”no-cache, mustrevalidate”>
    
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="CSS/Pag-Administrador-(Dispositivos).css">
   
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
                <a class="Link-Nav" id="Button-active" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
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

         <div class="div-Button">
                <a href="Administrador(Formulario).php" class="Button">Añadir</a>
                <a href="Administrador(FormularioModificar).php" class="Button">Modificar</a>
            </div>

    </section>

    <!-- Sección de formulario -->
    <section class="Sec-Body1">
        <div class="div-Dispositivos">  
            <div class="div-Search_Filtro">
                <div class="div-search">
                    <svg class="SVG-search" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px" width="200px"
                     xmlns="http://www.w3.org/2000/svg"><path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64
                      132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 
                      6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 
                      85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path></svg>          
                    <input class="Input-search" type="search" placeholder="Buscar" id="searchInput" onkeyup="buscarDispositivos()">
                </div>
                <!-- Sección de filtro -->
                <div class="div-filtro">
                    <!-- Botón para activar el menú de filtros -->
                    <button id="filterButton" title="Filtrar" class="Filter">
                        <svg class="Filtro-ICO" viewBox="0 0 512 512" height="1em">
                            <path
                                d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 
                                448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 
                                48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 
                                32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 
                                32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 
                                32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192  128a32 32 0 1 1 0-64 32 32 
                                0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32  64C14.3 64 0 78.3 0 96s14.3 
                                32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z">
                            </path>
                        </svg>
                    </button>
                    <div id="filterMenu" class="menu oculto">
                        <h3>Filtros</h3>
                
                        <!-- Filtro por estado -->
                        <div class="filter-section">
                            <label class="filter-label">Estado:</label>
                            <div class="estado-inline">
                                <ul class="filtro-ul">
                                    <li class="filtro-li">
                                        <input type="checkbox" class="filter-checkbox" value="Arreglado"> Arreglado
                                    </li>
                                    <li class="filtro-li">
                                        <input type="checkbox" class="filter-checkbox" value="Reparando"> Reparando
                                    </li>
                                    <li class="filtro-li">
                                        <input type="checkbox" class="filter-checkbox" value="Analisis"> Análisis
                                    </li>
                                </ul>
                            </div>
                        </div>
                
                        <!-- Filtro por fecha de entrada -->
                        <div class="filter-section">
                            <label class="filter-label">Fecha de entrada:</label>
                            <input type="date" id="startDate" class="filter-input">
                        </div>
                
                        <!-- Filtro por fecha de salida -->
                        <div class="filter-section">
                            <label class="filter-label">Fecha de salida:</label>
                            <input type="date" id="endDate" class="filter-input">
                        </div>
                
                        <!-- Botón para limpiar filtros -->
                        <button id="clearFiltersButton" class="clear-filters-button">Eliminar Filtros</button>
                    </div>
                </div>


                </div>
            </div>             

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


            <!-- Sección de paginación -->
            <section class="Sec-Paginas">
                <div class="div-paginas">
                    <!-- Botón Anterior -->
                    <a class="Num-Pag" href="?page=<?php echo max(1, $page - 1); ?>">❮</a>

                    <!-- Números de página dinámicos -->
                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                        <a class="Num-Pag <?php echo $i == $page ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Botón Siguiente -->
                    <a class="Num-Pag" href="?page=<?php echo min($total_pages, $page + 1); ?>">❯</a>
                </div>
            </section>


        </div>
    </section>

    <script src="JavaScript/Administrador-(Dispositivos).js"> </script>
    <script src="JavaScript/Administrador-(Cuenta).js"></script>

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