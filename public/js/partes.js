function activeButtons(parte) {
    $('tbody > tr').each(function(index, tr) {
        $(`#${tr.id}`).removeClass('active-table');
    });
    $(`#${parte}`).addClass('active-table');        
    $('#add-tipo').removeAttr('disabled');
    $('#add-expectativa').removeAttr('disabled');
}

function addTipo(nombre) {
    var parte = $('.active-table').attr('id');    
    $.ajax({
        url: `/Atenea/public/index.php/partes/tipo/new/${nombre}/${parte}`,        
        success (response) {
            location.reload();
        },
        error (jqXHR,status,errorThrown){
            location.reload();
        }
    })
}