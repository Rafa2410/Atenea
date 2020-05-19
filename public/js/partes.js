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
    $('.active-table #tipos').append(nombre);    
    $.ajax({
        url: `/Atenea/public/index.php/partes/tipo/new/${nombre}/${parte}`,        
        success (response) {
            M.toast({
                html: 'Tipo '+response+' creado!',
                classes: 'green lighten-1'
            });
        },
        error (jqXHR,status,errorThrown){
            console.log("Error" + status);
        }
    })
}

function addExpectativa(nombre) {
    var parte = $('.active-table').attr('id');
    $('.active-table #expectativas').append(nombre);
    $.ajax({
        url: `/Atenea/public/index.php/partes/expectativa/new/${nombre}/${parte}`,        
        success (response) {
            M.toast({
                html: 'Expectativa '+response+' creada!',
                classes: 'green lighten-1'
            });
        },
        error (jqXHR,status,errorThrown){
            console.log("Error" + status);
        }
    })
}