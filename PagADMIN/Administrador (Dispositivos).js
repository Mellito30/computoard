// Muestra o oculta el menú principal al hacer clic en el botón// Mostrar/ocultar el menú de filtros
document.getElementById('filterButton').addEventListener('click', function () {
  const filterMenu = document.getElementById('filterMenu');
  filterMenu.classList.toggle('oculto');
});

// Limpiar filtros seleccionados
document.getElementById('clearFiltersButton').addEventListener('click', function () {
  document.querySelectorAll('.filter-checkbox').forEach(checkbox => checkbox.checked = false);
  document.getElementById('startDate').value = '';
  document.getElementById('endDate').value = '';
});

// Ejemplo para obtener valores seleccionados (puedes personalizarlo)
function getSelectedFilters() {
  const selectedStates = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
      .map(checkbox => checkbox.value);
  const startDate = document.getElementById('startDate').value;
  const endDate = document.getElementById('endDate').value;

  console.log({ selectedStates, startDate, endDate });
}

// Llamar a `getSelectedFilters` cuando desees obtener los valores seleccionados



function buscarDispositivos() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const dispositivos = document.getElementsByClassName('div-Info-Dispositivos');
  const dispositivosNegros = document.getElementsByClassName('div-Info-dispo-BGBLACK');

  // Filtrar dispositivos en color normal
  for (let i = 0; i < dispositivos.length; i++) {
      const estado = dispositivos[i].getElementsByClassName('Text-info-Dispositivos')[0].textContent.toLowerCase();
      const modelo = dispositivos[i].getElementsByClassName('Text-info-Dispositivos')[1].textContent.toLowerCase();
      const departamento = dispositivos[i].getElementsByClassName('Text-info-Dispositivos')[2].textContent.toLowerCase();
      
      if (estado.includes(filter) || modelo.includes(filter) || departamento.includes(filter)) {
          dispositivos[i].style.display = "";
      } else {
          dispositivos[i].style.display = "none";
      }
  }

  // Filtrar dispositivos en color negro
  for (let i = 0; i < dispositivosNegros.length; i++) {
      const estado = dispositivosNegros[i].getElementsByClassName('Text-info-Dispositivos')[0].textContent.toLowerCase();
      const modelo = dispositivosNegros[i].getElementsByClassName('Text-info-Dispositivos')[1].textContent.toLowerCase();
      const departamento = dispositivosNegros[i].getElementsByClassName('Text-info-Dispositivos')[2].textContent.toLowerCase();
      
      if (estado.includes(filter) || modelo.includes(filter) || departamento.includes(filter)) {
          dispositivosNegros[i].style.display = "";
      } else {
          dispositivosNegros[i].style.display = "none";
      }
  }
}