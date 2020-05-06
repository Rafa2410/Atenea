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
/*
const unidades = $('#unidades');

if (unidades) {
  unidades.bind('click', function(e) {
    if (e.target.className === 'btn red darken-1') {
      if(confirm('Estas seguro?')) {        
        const id = e.target.getAttribute('data-id');
        
        $.ajax({
          url: `/Atenea/public/index.php/unidad/eliminar/${id}`,
          type: 'DELETE',
          success (response) {
            location.reload();
          },
          error (jqXHR,status,errorThrown){
            console.log(`Error en la petición AJAX ${status}`)
          }
        })
      }
    }
  });
}
*/