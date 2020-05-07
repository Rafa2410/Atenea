$(document).ready(function () {
    console.log("fce js");
});

$("#aspectos_favorables").click(function (e) {
    console.log("favorables");
    e.preventDefault();
    $.ajax({
        url: `/Atenea/public/index.php/factores/potenciales/de/exito/new/1`,
        type: 'GET',
        data : 1,
        success(response) {
            console.log("favorables");
            $("#aspectos").replaceWith($(response).find("#aspectos"));
        },
        error(jqXHR, status, errorThrown) {
            console.log(`Error en la petición AJAX ${status}`)
        }
    })

});

$("#aspectos_desfavorables").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: `/Atenea/public/index.php/factores/potenciales/de/exito/new/0`,
        type: 'GET',
        data: 0,
        success(response) {
            console.log("desfavorables");
            $("#aspectos").replaceWith($(response).find("#aspectos"));

        },
        error(jqXHR, status, errorThrown) {
            console.log(`Error en la petición AJAX ${status}`)
        }
    })

});
