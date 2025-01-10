
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
 
 
<!-- Sección de títulos -->
 <section class="Sec-Body1">
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
    </section>

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

