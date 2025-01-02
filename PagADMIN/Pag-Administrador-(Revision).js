//  // Verificar si el usuario está logueado
//  const EstaLogueado = sessionStorage.getItem("EstaLogueado");
//  if (EstaLogueado !== "true") {
//      // Si no está logueado, redirigir al login
//      window.location.href = "Login.php";
//  }



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

// // Muestra o oculta la info del alertS
// document.getElementById('AlertButtum').addEventListener('click', function () {
//     const ALertsoli = document.getElementById('ALertsoli');
//     ALertsoli.classList.toggle('oculto');
//   });


// Abrir el modal
function openModal() {
    const modal = document.getElementById('modal');
    modal.classList.remove('hidden'); // Quita la clase que oculta el modal
}

// Cerrar el modal
function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.add('hidden'); // Añade la clase que oculta el modal
}

// Manejar el envío del formulario
document.getElementById('modal-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que la página se recargue
    const nombreUsuario = document.getElementById('nombre-usuario').value;
    const comentario = document.getElementById('comentario').value;

    // Aquí puedes enviar los datos al servidor o manejar la lógica
    console.log("Nombre del usuario:", nombreUsuario);
    console.log("Comentario:", comentario);

    closeModal(); // Cierra el modal después del envío
    alert("Solicitud aceptada con éxito");
});
