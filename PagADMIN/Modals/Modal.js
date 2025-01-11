// Función para abrir el modal y mostrar el mensaje
function openModal(message) {
    document.getElementById('modal-message').textContent = message;  // Establecer el mensaje
    document.getElementById('modal').style.display = 'block';  // Mostrar el modal
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('modal').style.display = 'none';  // Ocultar el modal
}

// Si hay un mensaje PHP, abrir el modal con ese mensaje
document.addEventListener("DOMContentLoaded", function() {
    var mensajePHP = document.getElementById('php-mensaje');
    if (mensajePHP && mensajePHP.textContent) {
        openModal(mensajePHP.textContent);  // Mostrar el mensaje PHP en el modal
    }
});
