function editarCuestion() {    
    var id = $('#cuestiones option:selected').val();
    
    window.location.href = `/Atenea/public/index.php/cuestion/externa/edit/${id}`;
}