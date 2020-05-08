$(document).ready(function(){
    $('select').formSelect();
    var path = window.location.pathname;
    var res = path.split('/');
    if (res[jQuery.inArray("index.php", res)+1] == 'aspecto') {
        $('#aspecto_cuestiones').attr('style','display: none !important');
    } else {
        compruebaAspectos();
        $('#factores_criticos_de_exito_aspectosFav').attr('style','display: none !important');
        $('#factores_criticos_de_exito_aspectosDes').attr('style','display: none !important');
        $('#factores_criticos_de_exito_aspecto').attr('style','display: none !important');    
        // Comprueba si la pagina ha sido recargada
        if (!localStorage.getItem("reload")) {
            //Cambia el reload a true y recarga la pagina
            localStorage.setItem("reload", "true");
            location.reload();
        }
        //Elimina "reload" del localStorage para que no vuelva a recargarse
        else {
            localStorage.removeItem("reload");        
        }
    }
    /*$("#buttonOpor").on('click',function (e) {
        var id = $('#aspecto option:selected').val();
        window.location.href = `/Atenea/public/index.php/aspecto/edit/${id}/${aspec}`;
    });*/
});

function compruebaAspectos() {    
    var encontrado = false;
    $('#factores_criticos_de_exito_aspecto option').each(function(index, item) {
        if (item.defaultSelected) {            
                encontrado = false;            
                $('#factores_criticos_de_exito_aspectosDes option').each(function(indexDes, itemDes) {                    
                if (item.innerText === itemDes.innerText) {
                    encontrado = true;
                    itemDes.defaultSelected = true;
                }
            });
            if (!encontrado) {
                $('#factores_criticos_de_exito_aspectosFav option').each(function(indexFav, itemFav) {
                    if (item.innerText === itemFav.innerText) {                        
                        encontrado = true;
                        itemFav.defaultSelected = true;
                    }
                });
            }
        }
    });        
}
