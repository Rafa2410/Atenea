$(document).ready(function(){
    $('select').formSelect();    
    $('#aspecto_cuestiones').attr('style','display: none !important');
    $('#factores_criticos_de_exito_aspectosFav').attr('style','display: none !important');
    $('#factores_criticos_de_exito_aspectosDes').attr('style','display: none !important');
    /*$("#buttonOpor").on('click',function (e) {
        var id = $('#aspecto option:selected').val();
        window.location.href = `/Atenea/public/index.php/aspecto/edit/${id}/${aspec}`;
    });*/

});
