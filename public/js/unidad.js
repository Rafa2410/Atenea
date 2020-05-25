$(document).ready(function(){  
  if($('#unidad_tipo').val() != 1) {
    $('#corporacion').removeClass('escondido');
  }
});
$('#unidad_tipo').change(function() {  
  if ($('#unidad_tipo').val() != 1) {
    $('#corporacion').removeClass('escondido');
  } 
  if ($('#unidad_tipo').val() == 1) {
    $('#corporacion').addClass('escondido');
  }  
});

function confirmacion(item) {
  var ruta = item.dataset.href;
  var nombre = item.dataset.nombre;
  if (nombre) {
    $('#delete-corporacion').text(nombre);
  }  
  $('#confirmacion').attr('href',ruta);
}