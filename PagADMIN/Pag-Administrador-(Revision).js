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



  
// Open Modal
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
}

// Close Modal
function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

// Handle Form Submission
document.getElementById('modal-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const nombreUsuario = document.getElementById('nombre-usuario').value;
    const comentario = document.getElementById('comentario').value;
    
    console.log("Nombre del usuario:", nombreUsuario);
    console.log("Comentario:", comentario);
    
    closeModal();
    alert("Solicitud aceptada con éxito");
});
