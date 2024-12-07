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
