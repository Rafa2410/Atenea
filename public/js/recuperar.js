$('#boton-recuperar').click(function (e) {
    e.preventDefault();
    $email = $('#email').val();
    console.log($email);
    $.ajax({
        url: `/Atenea/public/index.php/change/password`,
        method: 'POST',
        data: $email,
        success: function (response) {

        }, error: function (xhr,status) {
            alert("Ha ocurrido un error! "+status);
        }
    });

});