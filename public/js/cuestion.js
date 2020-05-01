
function editarCuestion() {
    var id = $('#cuestiones option:selected').val();
    //console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/externa/edit/${id}`;
}

function editarSubtipoCuestion() {
    var id = $('#subtipos option:selected').val();
    //console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/externa/subtipo/edit/${id}`;
}

function editartipoCuestion(){
    var id = $('#tipos option:selected').val();
    //console.log(id);
    window.location.href = `/Atenea/public/index.php/cuestion/externa/tipo/edit/${id}`;
}