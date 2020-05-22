function activeButtons(parte) {    
    $('tbody > tr').each(function(index, tr) {
        $(`#${tr.id}`).removeClass('active-table');
    });
    $(`#${parte}`).addClass('active-table');
    $('#add-expectativa').removeAttr('disabled');
}

function addTipo(nombre) {    
    $.ajax({
        url: `/Atenea/public/index.php/partes_interesadas/new/tipo/${nombre}`,        
        success (response) {            
            M.toast({
                html: `Tipo ${response.nombre} creado!`,
                classes: 'green lighten-1'
            });
            $('select').append($(`<option value="${response.id}">${response.nombre}</option>`))
            $('select').trigger('contentChanged');
        },
        error (jqXHR,status,errorThrown){
            console.log("Error" + status);
        }
    })
}

$('select').on('contentChanged', function() {
    $(this).formSelect(); 
});

function addExpectativa(nombre) {
    var parte = $('.active-table').attr('id');    
    $.ajax({
        url: `/Atenea/public/index.php/partes/expectativa/new/${nombre}/${parte}`,        
        success (response) {
            M.toast({
                html: 'Expectativa '+response+' creada!',
                classes: 'green lighten-1'
            });
            $('.active-table #expectativas').append(response);
        },
        error (jqXHR,status,errorThrown){
            console.log("Error" + status);
        }
    })    
}