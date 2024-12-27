// Función para mostrar los detalles del perfil
function toggleProfileDetails() {
    const profileContainer = document.getElementById('profileContainer');
    
    // Crear el nuevo contenido con la imagen pequeña, nombre, apellidos, rango y opción de cerrar sesión
    const profileDetails = `
        <div class="profile-details">
            <img class="profile-img-small" src="img/Icono-perfil.png" alt="Icono-Perfil">
            <div class="profile-info">
                <p><strong>Nombre:</strong> Juan Pérez</p>
                <p><strong>Rango:</strong> Administrador</p>
            </div>
        </div>
        <button class="btn-logout" onclick="logout()">Cerrar Sesión</button>
    `;
    
    // Reemplazar el avatar con los detalles del perfil
    profileContainer.innerHTML = profileDetails;
}

// Función para simular el cierre de sesión
function logout() {
    alert('Cerrando sesión...');
    window.location.href = 'Login.php'; // O la URL de la página de cierre de sesión
}
