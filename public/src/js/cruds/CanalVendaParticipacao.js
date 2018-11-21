let FormParticipacao = {
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
                if (data.code !== 0) {
                    swal({
                        title:'Ocorreu uma falha',
                        text:data.message,
                        type:'error'
                    });
                } else {
                    swal({
                        title:'Sucesso',
                        text:data.message,
                        type:'success'
                    });

                }
            },
            error:function(data){
                console.log(data);
                swal({
                    title:'Error',
                    html: data.message,
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

// ############################################ Object Participacao #######################################
let Participacao = {
    Save: function (id) {
        
        let formulario = $("#"+id);

        FormParticipacao.validate(formulario);
        
        formulario.on('submit', function (event) {
            event.preventDefault();
            
            if (FormParticipacao.valid(formulario)) {
                FormParticipacao.send(formulario);
            }
        });
    },

    deletar:function(acao, $table) {
        $(document).on('click',acao,function(e){

            e.preventDefault();

            var url = $(this).prop('href');

            swal({
                title: 'Vocẽ tem certeza?',
                text: "Você não poderá reverter isso!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#063346',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!'
            }).then((result) => {
                if (result.value) {

                $.ajax({
                    url:url,
                    type:'get',
                    dataType:'json',
                    beforeSend:function(){
                        showLoading('Aguarde, dados sendo excluídos');
                    },
                    success:function(data){

                        if (data.code !== 0) {
                            swal({
                                title:'Ocorreu uma falha',
                                text:data.message,
                                type:'error'
                            });
                        } else {
                            swal({
                                title:'Sucesso',
                                text:data.message,
                                type:'success'
                            });

                        }

                        if($table) {
                            $table.ajax.reload();
                        }
                    },
                    error:function(dados){
                        return Form.obterRetornoDeErros(dados);
                    }
                });

            }
        });

            return false;

        });
    }
};

Participacao.Save('FormCanalVendaParticipacao');