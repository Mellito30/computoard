<?php

// Configuración de la conexión a la base de datos
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte De Dispositivos</title>
    <link rel="stylesheet" href="Dispositivos.css">
</head>
<body>
      <!-- Sección de barra -->
      <section class="Sec-Header">
        <!-- <a class="Logo-ARM-link" href="index.php"> -->
            <img class="Logo-ARM" src="img/LOGOARM.png" alt="EscudoARM">
        <!-- </a> -->
        <!-- Sección de formulario -->
        <div class="div-formulario">
                <a class="Inicio" href="index.php">Inicio</a>
                <a class="Formulario" href="formulariousuario.php">Solicitud de Formulario</a>
            </div>
        </section>
 
 <!-- Sección de dispositivos -->
<section class="Sec-Body1">
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
            $is_black = false;
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
</section>

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


       
        <!-- Footer -->
    <section class="Sec-Footer">
        <img class="Logo-ARM-Footer" src="img/LOGOARM.png" alt="EscudoARM">    
        <img class="Logo-GRD-Footer" src="img/LOGOMINIS.png" alt="LogoMinisterio">
        <div class="div-text-footer">
            <h4 class="Title-footer">CONÓCENOS</h4>
            <p class="Text-footer">Armada De La República Dominicana</p>
        </div>
        <div class="div-text-footer">
            <h4 class="Title-footer">CONTÁCTANOS</h4>
            <p class="Text-footer">Tel: (809) 593-5900 Ext. 5242  5237 Fax: (809) 598-1060 info@armada.mil.do</p>
        </div>
        <div class="div-text-footer">
            <h4 class="Title-footer">BÚSCANOS</h4>
            <p class="Text-footer">Ave. España, Punta Torrecilla, Sans Soucí, Villa Duarte, Santo Domingo Este, PSD</p>
        </div>
    </section>

</body>
</html>

