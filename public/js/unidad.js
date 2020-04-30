$(document).ready(function(){
  $('.tabs').tabs();
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