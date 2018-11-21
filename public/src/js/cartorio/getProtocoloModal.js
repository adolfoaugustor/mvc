$(document).on('click','.acaoInformarRegistro', function(){

    let protocolo = $(this).parents('tr').data('protocolo');
    // console.log(protocolo);
    $('input[name="protocolo"]').val(protocolo);

});

$('#informarRegistro').on('hidden.bs.modal', function () {
    // console.log(protocolo);
    $('input[name="protocolo"]').val(" ");
});
