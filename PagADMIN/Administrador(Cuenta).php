<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Usuarios</title>
    <link rel="stylesheet" href="Pag-Administrador-(Cuenta).css">
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
                    <a class="Link-Nav" href="Administrador(Revision).php">Solicitudes de Servicios</a><br>
                    <a href="Administrador(Cuenta).php">
                      <img class="Ico-Nav" src="/img/Icono-perfil.png" alt="Icono-Perfil" href="#">
                    </a>            
                </li>
            </ul>
        </nav>
    </section>
  
        <!-- Sección de encabezado -->
    <section class="Header">
         <h1 class="Title1">...</h1>
    </section>

    <!-- Sección de formulario -->
    <section class="Sec-Body1">
        <div class="Info-Usuario">
            <label for=""> nombre de usuario</label>
            <input type="text"  >

        </div>
       
    </section>

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