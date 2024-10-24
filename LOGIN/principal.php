<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte De Dispositivos</title>
    <link rel="stylesheet" href="principal.css">
</head>
<body>
      <!-- Sección de barra -->
      <section class="BA">
        <img class="ESARM" src="img/LOGOARM.png" alt="EscudoARM">
    </section>
 
    
    <!-- Sección de titulos de dispositivos -->
     <section class="SETIDI">
        <h1 class="TIDIS">Dispositivos y Maquinas</h1>
            <div class="TITADI">
                    <h3 class="TITETADI" >Estado</h3>
                    <h3 class="TITETADI" >Equipo</h3>
                    <h3 class="TITETADI" >Departamento</h3>
                    <h3 class="TITETADI" >Fecha de Entrada</h3>
                    <h3 class="TITETADI" >Fecha de Salida</h3>
            </div>
        </section>
            <div class="LIGRTADI"></div>

        <!-- Sección de dispositivos -->

        <section class="SEDI">
            <div class="SEDIBLA">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>

        <section class="SEDI">
            <div class="SEDINE">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>
     
        <section class="SEDI">
            <div class="SEDIBLA">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>

        <section class="SEDI">
            <div class="SEDINE">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida.</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>
     
        <section class="SEDI">
            <div class="SEDIBLA">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>

        <section class="SEDI">
            <div class="SEDINE">
                    <p class="TETADI" >Estado</p>
                    <p class="TETADI" >Equipo</p>
                    <p class="TETADI" >Departamento</p>
                    <p class="TETADI" >Fecha de Entrada</p>
                    <p class="TETADI" >Fecha de Salida</p>
            </div>
        </section>
                <div class="LIGRTADI"></div>
     

</body>
</html>


<script>
        // Verificar si el usuario está logueado
        const EstaLogueado = sessionStorage.getItem("EstaLogueado");

        if (EstaLogueado !== "true") {
            // Si no está logueado, redirigir al login
            window.location.href = "login.php";
        }
    </script>