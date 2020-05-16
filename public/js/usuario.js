$('#usuario_email').change(function() {
    compruebaEmails($('#usuario_email').val());
    //console.log();
});

function compruebaEmails(email) {
    var pathname = window.location.pathname;
    var id = pathname.split('/');
    //id[id.length-1]
    $.ajax({
        url: '/Atenea/public/index.php/register/getEmails',
        success: function(result) {
            console.log(result);
        }
    });
}