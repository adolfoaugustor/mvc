let table = Datatables.carregarTabela({
    id:'listarRegistroDocumentos',
    url:'/cartorio/registro-documentos/listar',
    colunas:[
        'checkbox',
        'protocolo',
        'data_protocolo',
        'nome',
        'acao'
    ],
    ordem:[1,'desc'],
    buttons:[
        'pdf','csv'
    ],
    extra: {
        'columnDefs': [{
            'targets': 0,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox" name="protocolo[]" value="' + $('<div/>').text(data).html() + '">';
            },
            'checkboxes': {
                'selectRow': true
            }
        }],
    },
});

// Handle click on "Select all" control
$('#example-select-all').on('click', function(){
    // Check/uncheck all checkboxes in the table
    var rows = table.rows({ 'search': 'applied' }).nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
});

// Handle click on checkbox to set state of "Select all" control
$('#listarRegistroDocumentos tbody').on('change', 'input[type="checkbox"]', function(){
    // If checkbox is not checked
    if(!this.checked){
        var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
        }
    }
});

table.draw();
// Crud.Save('#frm-registro', table);
Form.validate($('#frm-registro'),{
    submitHandler: function (form) {
        let $checkbox = $('input[name="protocolo[]"]').is(':checked');
        console.log($checkbox);
        if (!$checkbox){
            swal("Precisa selecionar pelo menos um!");
            return false;
        }
        // Form.send(form);
        jQuery.ajax({
            url: $(form).prop('action'),
            data: $(form).serialize(),
            dataType: 'json',
            type: 'post',
            beforeSend:function(){
                showLoading('Aguarde, carregando');
            },
            success:function(data){

                swal({
                    title:'Sucesso',
                    text:data.message,
                    type:'success'
                });
                table.ajax.reload();
                table.draw();
                esconderBotaoAssinar();

            },
            error:function(data) {
                Form.obterRetornoDeErros(data);
            }
        });

        return false;
    }
});
function esconderBotaoAssinar() {
    setTimeout(function () {
        $('table tbody tr td.dataTables_empty').length > 0 ? $('.assinarLote').hide() : $('.assinarLote').show();
    }, 1000)
}
esconderBotaoAssinar();
