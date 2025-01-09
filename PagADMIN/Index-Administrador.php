<?php
session_start();  // Iniciar la sesión

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigimos al login
    header("Location: login.php");
    exit();
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
    <link rel="stylesheet" href="Pag-Administradorrr.css">
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
                        <p><strong>Nombre:</strong> Juan Pérez</p> <!-- Sustituir por datos dinámicos -->
                        <p><strong>Rango:</strong> Administrador</p>
                    </div>
                </div>
                <button class="btn-logout" onclick="logout()">Cerrar Sesión</button>
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
        <!-- Contenedor de recordatorios -->
        <div class="contenedor-recordatorios">

            <div class="recordatorio">
                <div class="encabezado">
                    <div class="nombre-rango">
                        <span class="nombre">Comandante JCK</span>
                        <span class="rango">(Capitán Navío)</span>
                    </div>
                    <div class="fecha-aceptada">
                        Aceptado: <span>06/12</span>
                    </div>
                </div>
                <div class="detalles">
                    <span class="departamento">Cómputo</span>
                    <span class="fecha-solicitada">Solicitado: <span>05/12</span></span>
                </div>
            </div>

            <div class="recordatorio">
                <div class="encabezado">
                    <div class="nombre-rango">
                        <span class="nombre">Comandante JCK</span>
                        <span class="rango">(Capitán Navío)</span>
                    </div>
                    <div class="fecha-aceptada">
                        Aceptado: <span>06/12</span>
                    </div>
                </div>
                <div class="detalles">
                    <span class="departamento">Cómputo</span>
                    <span class="fecha-solicitada">Solicitado: <span>05/12</span></span>
                </div>
            </div>
            
            <div class="recordatorio">
                <div class="encabezado">
                    <div class="nombre-rango">
                        <span class="nombre">Comandante JCK</span>
                        <span class="rango">(Capitán Navío)</span>
                    </div>
                    <div class="fecha-aceptada">
                        Aceptado: <span>06/12</span>
                    </div>
                </div>
                <div class="detalles">
                    <span class="departamento">Cómputo</span>
                    <span class="fecha-solicitada">Solicitado: <span>05/12</span></span>
                </div>
            </div>
            
            
            
        </div>
    </div>                                 
            

            <!-- Recuadro 2: Formulario de ingreso -->
            <div class="recuadro formulario">
                <h3>Formulario de Ingreso</h3>
                <form action="#" method="post">
                    <label for="dispositivo">Dispositivo:</label>
                    <input type="text" id="dispositivo" name="dispositivo">
                    <button type="submit">Ingresar</button>
                </form>
            </div>

        </div> 

        <!-- Recuadro 3: Lista de dispositivos recientes -->
        <div class="recuadro dispositivos">
            <h3>Dispositivos Recientes</h3>
            <ul>
                <li>Dispositivo 1: Marca, Modelo, Fecha</li>
                <li>Dispositivo 2: Marca, Modelo, Fecha</li>
            </ul>
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