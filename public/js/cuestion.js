function editarCuestion() {    
    var id = $('#cuestiones option:selected')[0].id;

    window.location.href = `/Atenea/public/index.php/cuestion/externa/edit/${id}`;
}