var Crud = {

    Save: function (id,$table,opcoes) {

       var formulario = $('form#'+id);

        Form.validate(formulario,opcoes);

        formulario.on('submit',function(event){
            event.preventDefault();

            if(Form.valid(formulario)){

                Form.send(formulario);

                if($table) {
                    $table.ajax.reload();
                    $table.draw();
                }

            }

        })

    },

    deletar:function(acao,$table){

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

                            swal({
                                title:'Sucesso',
                                text:data.message,
                                type:'success'
                            });

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

//Crud.Save('FormPessoa');
//Crud.Save('FormUpdatePessoa');
//Crud.Save('FormPessoaFisica');
//Crud.Save('FormUpdatePessoaFisica');
//Crud.Save('FormEndereco');
//Crud.Save('FormUpdateEndereco');
//Crud.Save('FormPessoaJuridica');
//Crud.Save('FormUpdatePessoaJuridica');
//Crud.Save('FormFormaContato');
//Crud.Save('FormUpdateFormaContato');
Crud.Save('FormFinanceiroTaxaConvenienciaVirgencia');
Crud.Save('FormTiposEstornoForm');
Crud.Save('FormTaxasCustas');
Crud.Save('FormTiposReceitas');
// Crud.Save('FormTipoTaxasCustas');
