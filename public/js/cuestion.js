$(document).ready(function(){
    $('select').formSelect();    
    $('#aspecto_cuestiones').attr('style','display: none !important');
    /*$("#buttonOpor").on('click',function (e) {
        var id = $('#aspecto option:selected').val();
        window.location.href = `/Atenea/public/index.php/aspecto/edit/${id}/${aspec}`;
    });*/

});
function editarCuestion() {
    var id = $('#cuestiones option:selected').val();
    console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/edit/${id}`;
}

function editarSubtipoCuestion() {
    var id = $('#subtipos option:selected').val();
    //console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/subtipo/edit/${id}`;
}

function editartipoCuestion(){
    var id = $('#tipos option:selected').val();
    //console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/tipo/edit/${id}`;
}

function editarAspecto(aspec){
    var id = $('#aspecto option:selected').val();
    window.location.href = `/Atenea/public/index.php/aspecto/edit/${id}/${aspec}`;
}

function redirige(){
    window.location.href = `/Atenea/public/index.php/cuestion/${id}/`;
}

function eliminarCuestionDeAspecto(){
    var id = $('#aspecto_cuestiones option:selected').val(); //id de la cuestion a eliminar
    console.log(id);
    var paginaUrl = window.location.search().substring(1);
    var urlSeparada = paginaUrl.split('/');
    for (var i = 0;1<urlSeparada.length;i++){
        console.log(urlSeparada[i]);
    }

    //window.location.href = `/Atenea/public/index.php/aspecto/edit/${id}/${aspec}`;
}