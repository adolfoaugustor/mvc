let MessageBox = {
    box: function (mensagem) {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
        });
        swalWithBootstrapButtons({
            title: 'Atenção',
            input: 'text',
            inputPlaceholder: 'Digite o novo valor da taxa...',
            inputAttributes: {
                autocapitalize: 'off',
            },
            html: mensagem,
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim finalizar, e adicionar a atual',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $("#valor").val(result.value);
                $("#FormTaxaConvenienciaVirgencia").attr('action', '/financeiro/taxa-conveniencia-virgencia/substituir');
                // formTeste.serialize();
                // console.log(formTeste);
                // Financeiro.Save("FormTaxaConvenienciaVirgencia");
                $("#submit-formulario").trigger('click');
                $("#FormTaxaConvenienciaVirgencia").attr('action', '/financeiro/taxa-conveniencia-virgencia/salvar');
                swalWithBootstrapButtons(
                    'Operação realiza com sucesso !',
                    'A taxa anterior foi finalizada, e adicionada a nova !',
                    'success'
                );
                return true;
            }
        });
    }
};

let FormFinanceiro = {
    send:function(formulario){
        formulario.validate();
        $.ajax({
            url:formulario.prop('action'),
            type:'post',
            dataType:'json',
            data:formulario.serialize(),
            beforeSend:function(){
                showLoading('Aguarde, carregando');
            },
            success:function(data){
                swal({
                    title:'Sucesso',
                    text:data.message,
                    type:'success'
                });
            },
            error:function(data){

                let mensagens = '';
                let codigo    = 0;
                let dados     = data.responseJSON;
                // mensagens     += dados.message;

                if (dados.errors !== null && dados.errors.hasOwnProperty('code') === false) {
                    dados.errors.map(function (error) {
                        mensagens += "<div class='text-danger'>" + error + "</div>";
                    });
                }

                if (dados.errors !== null && dados.errors.hasOwnProperty('code') === true) {
                    mensagens += "<div class='text-danger'>" + dados.errors.message + "</div>";
                    codigo = dados.errors.code;
                }

                if (codigo > 0) {
                    MessageBox.box(mensagens);
                    return true;
                }

                swal({
                    title:'Error',
                    html: mensagens,
                    type:'error'
                });
                return true;
            }
        });
    },
    validate:function(formulario,options){
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid",
            ignore: []
        });
        formulario.validate(options);
    },
    valid:function(formulario) {
        return formulario.valid();
    },
    obterRetornoDeErros:function(dados){
        console.log(dados);
    }
};

// ############################################ Object Financeiro #######################################
let Financeiro = {
    Save: function (id) {
        
        let formulario = $("form#"+id);
        
        FormFinanceiro.validate(formulario);
        
        formulario.on('submit', function (event) {
            event.preventDefault();
            
            if (FormFinanceiro.valid(formulario)) {
                FormFinanceiro.send(formulario);
            }
        });
    }
};

Financeiro.Save('FormTaxaConvenienciaVirgencia');
Financeiro.Save('FormTipoTaxasCustas');
Financeiro.Save('FormTiposPagamentos');