// Seleccionar todas las estrellas
const stars = document.querySelectorAll('.star');

// Cambiar el estado de la estrella
stars.forEach(star => {
    star.addEventListener('click', () => {
        star.classList.toggle('starred');
        const isStarred = star.classList.contains('starred');
        star.setAttribute('data-starred', isStarred.toString());
    });
});

// Seleccionar los detalles para expandir/colapsar
const detalles = document.querySelectorAll('.solicitud-detalle');

// Lógica para expandir y colapsar texto
detalles.forEach(detalle => {
    detalle.addEventListener('click', () => {
        const isExpanded = detalle.classList.toggle('expandido');
        detalle.style.whiteSpace = isExpanded ? 'normal' : 'nowrap';
        detalle.style.overflow = isExpanded ? 'visible' : 'hidden';
        detalle.style.textOverflow = isExpanded ? 'unset' : 'ellipsis';
    });
});

// Muestra o oculta la info del alertS
document.getElementById('AlertButtum').addEventListener('click', function () {
    const ALertsoli = document.getElementById('ALertsoli');
    ALertsoli.classList.toggle('oculto');
  });




// Obtener todos los botones de "Aceptar"
const botonesAceptar = document.querySelectorAll('.Buttom-solicitud.aceptar');

// Recorrer cada botón de aceptar
botonesAceptar.forEach(boton => {
    boton.addEventListener('click', (e) => {
        const nombreUsuario = e.target.getAttribute('data-nombre');
        const email = e.target.getAttribute('data-email');
        const solicitudId = e.target.getAttribute('data-id');

        // Seleccionar el modal específico para esta solicitud
        const modal = document.getElementById(`formularioModal_${solicitudId}`);
        const nombreUsuarioInput = document.getElementById(`nombreUsuario_${solicitudId}`);
        const comentariosInput = document.getElementById(`comentarios_${solicitudId}`);
        const guardarBtn = document.getElementById(`guardar_${solicitudId}`);
        const cancelarBtn = document.getElementById(`cancelar_${solicitudId}`);

        // Mostrar el modal cuando se haga clic en el botón
        modal.classList.toggle('oculto');

        // Rellenar el campo del nombre del usuario
        nombreUsuarioInput.value = nombreUsuario;

        // Enviar el comentario por correo electrónico al usuario
        guardarBtn.onclick = () => {
            const comentario = comentariosInput.value;
            if (comentario) {
                enviarComentario(solicitudId, email, comentario);
                modal.classList.add('oculto'); // Ocultar modal
                alert('Comentario enviado correctamente');
            } else {
                alert('Por favor, escribe un comentario');
            }
        };

        // Cerrar el modal sin hacer nada
        cancelarBtn.onclick = () => {
            modal.classList.add('oculto'); // Ocultar modal
        };
    });
});

// Función para enviar el comentario por correo
function enviarComentario(solicitudId, email, comentario) {
    const formData = new FormData();
    formData.append('id', solicitudId);
    formData.append('email', email);
    formData.append('comentario', comentario);

    // Usar fetch para enviar el comentario al servidor
    fetch('enviar_comentario.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log('Comentario enviado');
          } else {
              console.error('Error al enviar el comentario');
          }
      }).catch(error => console.error('Error:', error));
}
                