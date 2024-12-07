
<?php

//conexion con la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas otro usuario
$contrasena = ""; // Cambia esto si tienes contraseña
$base_datos = "armada_computoard";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre_solicitante = $_POST['nombre'];
    $rango_solicitante = $_POST['rango'];
    $nombre_departamento = $_POST['departamento'];
    $asunto = $_POST['asunto'];
    $correo_electronico = $_POST['correo'];
    $descripcion_solicitud = $_POST['descripcion'];

    //Ingresar los datos a la db
    $sql = "INSERT INTO solicitudes (nombre_solicitante, rango_solicitante, nombre_departamento, asunto, correo_electronico, descripcion_solicitud) 
            VALUES ('$nombre_solicitante', '$rango_solicitante', '$nombre_departamento', '$asunto', '$correo_electronico', '$descripcion_solicitud')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }

        // Redirigir para evitar reenvío de datos al recargar
        header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=" . urlencode($mensaje));
        exit;
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
    <title>Formulario de Facturación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="formulario-usuarios.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="invoice-container bg-white p-5 rounded shadow-lg">
            <header class="text-center position-relative mb-4">
                <div class="image-container">
                    <img src="/img/LOGOARM.png" alt="Logo" class="logo-img">
                </div>
                <h2 class="mt-3">Formulario de Reporte</h2>
                <p class="p">Reportes y Consultas</p>
            </header>

                        <form action="#" method="POST">
                <div class="mb-3">
                    <label for="NombreSoli" class="form-label"><strong>Nombre del Solicitante</strong></label>
                    <input type="text" id="NombreSoli" name="nombre" class="form-control" required placeholder="Introduzca su nombre">
                </div>
            
                <div class="mb-3">
                    <label for="NombreSoli" class="form-label"><strong>Rango del Solicitante</strong></label>
                    <input type="text" id="NombreSoli" name="rango" class="form-control" required placeholder="Introduzca su rango">
                </div>

                <div class="mb-3">
                    <label for="NomDep" class="form-label"><strong>Nombre del Departamento:</strong></label>
                    <input type="text" id="NomDep" name="departamento" class="form-control" required placeholder="Introduzca su departamento">
                </div>

                <div class="mb-3">
                    <label for="AsuntoDe" class="form-label"><strong>Asunto</strong></label>
                    <input type="text" id="AsuntoDe" name="asunto" class="form-control" required placeholder="Introduzca el titulo de su solicitud">
                </div>

                <div class="mb-3">
                    <label for="AsuntoDe" class="form-label"><strong>Correo Eletronico</strong></label>
                    <input type="email" id="AsuntoDe" name="correo" class="form-control" required placeholder="Introduzca su correo eletrónico">
                </div>
               
                    <div class="mb-3">
                        <label for="observaciones" class="form-label"><strong>Descripcion de la Solicitud:</strong></label>
                        <textarea id="observaciones" name="descripcion" rows="4" class="form-control" placeholder="Introduzca su problematica"></textarea>
                    </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.html" class="btn btn-dark">Volver</a>
                    <button type="submit" class="btn btn-custom">Enviar formulario</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
