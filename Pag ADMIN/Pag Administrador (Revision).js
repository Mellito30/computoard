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
