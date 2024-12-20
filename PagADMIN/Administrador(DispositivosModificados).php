
<?php

//conexion con la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas otro usuario
$contrasena = ""; // Cambia esto si tienes contraseña
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los datos de la tabla "dispositivos"
$sql = "SELECT estado, departamento, tipo_dispositivo, modelo, fecha_ingreso, fecha_salida FROM dispositivos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Dispositivos).css">
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
                    <a class="Link-Nav"id="Button-active" href="Administrador(Dispositivos).php">Revisión de Dispositivo</a><br>
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
            </div>

    </section>

    <!-- Sección de formulario -->
    <section class="Sec-Body1">
        <div class="div-Dispositivos">  

            

            <div class="div-Search_Filtro">
                <div class="div-search">
                    <img class="SVG-search" src="/img/search.svg" alt="Search">                
                    <input  class="Input-search" type="search" placeholder="Search" name="" id="">
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
                            32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"
                        ></path>
                    </svg>
                </button>
            
                <!-- Menú de filtro -->
                <div id="filterMenu" class="menu oculto">
                    <h3>Filtros</h3>
            
                    <!-- Filtro por estado -->
                    <div>
                        <label>Estado:</label>
                        <ul class="filtro-ul">
                            <li class="filtro-li" ><input type="checkbox" class="filter-checkbox" value="Arreglado"> Arreglado</li>
                            <li class="filtro-li" ><input type="checkbox" class="filter-checkbox" value="Reparando"> Reparando</li>
                            <li class="filtro-li" ><input type="checkbox" class="filter-checkbox" value="Analisis"> Análisis</li>
                        </ul>
                    </div>
            
                    <!-- Filtro por fecha de entrada -->
                    <div>
                        <label>Fecha de entrada:</label>
                        <input type="date" id="startDate">
                    </div> <br>
            
                    <!-- Filtro por fecha de salida -->
                    <div>
                        <label>Fecha de salida:</label>
                        <input type="date" id="endDate">
                    </div>
            
                    <!-- Botón para limpiar filtros -->
                    <button id="clearFiltersButton">Eliminar Filtros</button>
                </div>
            </div>
            
            </div>

<!-- Sección de títulos -->
<div class="div-dispositivos">
        <h3 class="Title-header-dispositivos">ID</h3>
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

                    <p class="Text-info-Dispositivos"><?php echo $row['ID']; ?></p>
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

    <script src="Administrador (DispositivosModificados).js"> </script>

</body>
</html>

<!-- <script>
    function showSubMenu() {
        const mainFilter = document.getElementById("main-filter");
        const subMenu = document.getElementById("sub-menu");
    
        // Muestra el submenú solo si una opción específica está seleccionada
        if (mainFilter.value !== "") {
            subMenu.style.display = "block";
        } else {
            subMenu.style.display = "none";
        }
    }
    </script> -->

<!-- <script>
        // Verificar si el usuario está logueado
        const EstaLogueado = sessionStorage.getItem("EstaLogueado");

        if (EstaLogueado !== "true") {
            // Si no está logueado, redirigir al login
            window.location.href = "login.php";
        }
    </script> -->


