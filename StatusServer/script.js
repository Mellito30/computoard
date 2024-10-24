document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_status.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('estado').textContent = `Estado: ${data.estado}`;
        });
});

document.getElementById('cambiarEstado').onclick = function() {
    fetch('update_status.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('estado').textContent = `Estado: ${data.estado}`;
        });
};
