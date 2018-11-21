
// Crud.save();
Form.validate($('#FormDadosRtd'), {
    submitHandler: function (form) {
        Form.send($('#FormDadosRtd'));
        $('#FormDadosRtd').find('input').val("");
        $('#FormDadosRtd').find('select').val("");
        $('#informarRegistro').modal('hide');
        return false
    }
});