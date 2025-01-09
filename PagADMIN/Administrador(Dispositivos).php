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
    <meta http-equiv=”Cache-Control” content=”no-cache, mustrevalidate”>
    
    <meta http-equiv=”Expires” content=”0″>
    
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Dispositivos).css">
   
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
                <a href="Administrador(Formulario).php" class="Button">Añadir</a>
                <a href="" class="Button">Modificar</a>
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

            <!-- Sección de títulos -->
            <div class="div-dispositivos">
                <h3 class="Title-header-dispositivos">Estado</h3>
                <h3 class="Title-header-dispositivos">Equipo</h3>
                <h3 class="Title-header-dispositivos">Departamento</h3>
                <h3 class="Title-header-dispositivos">Fecha de Entrada</h3>
                <h3 class="Title-header-dispositivos">Fecha de Salida</h3>
            </div>
            <div class="div-form-decorate"></div>

            <!-- Sección de dispositivos -->
            <div class="div-Lista-Dispositivos">
                <?php if ($result->num_rows > 0): ?>
                    <?php 
                    $is_black = false; // Para alternar clases
                    while ($row = $result->fetch_assoc()): 
                    ?>
                        <div class="<?php echo $is_black ? 'div-Info-dispo-BGBLACK' : 'div-Info-Dispositivos'; ?>">
                            <p class="Text-info-Dispositivos"><?php echo $row['estado']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['modelo']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['departamento']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['fecha_ingreso']; ?></p>
                            <p class="Text-info-Dispositivos"><?php echo $row['fecha_salida']; ?></p>
                            
                        </div>
                        <div class="div-form-decorate"></div>
                        <?php $is_black = !$is_black; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay dispositivos registrados.</p>
                <?php endif; ?>
            </div>

            <!-- Sección de paginación -->
            <section class="Sec-Paginas">
                <div class="div-paginas">
                    <a class="Num-Pag" href="#">❮</a>
                    <a class="Num-Pag" href="#">1</a>
                    <a class="Num-Pag" href="#">2</a>
                    <a class="Num-Pag" href="#">3</a>
                    <a class="Num-Pag" href="#">4</a>
                    <a class="Num-Pag" href="#">5</a>
                    <a class="Num-Pag" href="#">6</a>
                    <a class="Num-Pag" href="#">❯</a>
                </div>
            </section>

        </div>
    </section>

    <script src="Administrador-(Dispositivos).js"> </script>
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