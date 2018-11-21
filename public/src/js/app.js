$(function(){

    $("select").on("select2:close", function (e) {
        $(this).valid();
    });

    $(function () {
        $('select').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow_clear')),
            });
        });
    });

    var CPFCNPJMaskComportamento = function (val){
        return val.replace(/\D/g,'').length === 11 ? '000.000.000-000' : '00.000.000/0000-00';
    };

    var CpfCnpjOptions  = {
        onKeyPress:function(val,e,field,options){
            field.mask(CPFCNPJMaskComportamento.apply({},arguments),options);
        }
    };

    $('.cpfcnpj').mask(CPFCNPJMaskComportamento,CpfCnpjOptions);

    $('.date').mask('11/11/1111');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});






    //$.fn.select2.defaults.set('placeholder','Selecione uma opção');

    $('.select2').select2();

    $('.estado-select-2').select2().change(function(){

        var id = $(this).val();

        $.ajax({
            url:'/cidades/estado/'+ id,
            type:'get',
            success:function(data){
                var dados = "<option value=''>Selecione uma opção</option>";
                dados += data.dados.map(function(elem){
                    return "<option value='"+elem.cidade_id+"'>"+elem.desc_cidade+"</option>";
                });

                let dataLoadCidade = $('select[data-load="cidades"]');

                $('#idCidade_cidadeId').html(dados);

                if(dataLoadCidade){
                    dataLoadCidade.html(dados);
                }

            }

        });

    });

    $('select[data-load="cidades"]').select2().change(function(){

        let dataLoadCartorios = $('select[data-load="cartorios"]');
        let selectDivCartorio = $('#showCartorio');
        let selectCartorio = selectDivCartorio.find('select');
        let inputDiVCartorio =  $('#showNomeCartorio');
        let nomeCartorio = inputDiVCartorio.find('input');

        selectCartorio.prop('disabled','disabled');

        let id = $(this).val();

        /**
         * Se não tem por que não existe ( proverbio interior)
          */
        if(dataLoadCartorios){

            $.ajax({
               url:'/cartorios/cidade/'+id,
               type:'get',
               dataType:'json',
               success:function (data) {

                   /**
                    * Se nao existr
                   */

                   if(data.code === 9999){

                        selectCartorio.prop('disabled','disabled');
                        swal(data.message,'Preencha o nome do cartório para dar continuidade.');

                        inputDiVCartorio.show();
                        nomeCartorio.prop('disabled','');

                        return false;

                   }

                   var dados = "<option value=''>Selecione uma opção</option>";
                   dados += data.map(function(elem){
                       return "<option value='"+elem.ni+"'>"+elem.nome+"</option>";
                   });

                   selectCartorio.prop('disabled','').html(dados);

                   inputDiVCartorio.hide();
                   nomeCartorio.prop('disabled','disabled');
               }
            });
        }
    });

    //loadCidade('#id_cidade');

    $('.select2-ajax-pessoa').select2({
        ajax:{
            url:function(params){
                return '/suporte/pessoa/por-nome/'+params.term;
            },
            dataType: 'json',
            delay:100,
            processResults:function(dados){

                var data = $.map(dados,function(obj){
                    obj.id = obj.id || obj.ni;
                    obj.text = obj.text || obj.nome ? obj.ni +" - "+obj.nome : obj.ni+" - "+obj.nomeUsual;

                    return obj;
                });

                return {
                    results:data,
                    pagination:{
                        more:true
                    }
                };

            }

        }
    });

    $('.select2-ajax-cartorios').select2({
        ajax:{
            url:function(params){
                return '/application/cartorio/por-nome/'+params.term;
            },
            dataType: 'json',
            delay:100,
            processResults:function(dados){

                var data = $.map(dados,function(obj){
                    obj.id = obj.id || obj.ni;
                    obj.text = obj.text || obj.nome ? obj.ni +" - "+obj.nome : obj.ni+" - "+obj.nomeUsual;

                    return obj;
                });

                return {
                    results:data,
                    pagination:{
                        more:true
                    }
                };

            }

        }
    });

    $('.tipo-complemento-select2').select2({
        ajax:{
            url:function(params){
                return '/api/complemento/tipos'+params.term;
            },
            dataType: 'json',
            delay:100,
            processResults:function(dados){

                var data = $.map(dados,function(obj){
                    obj.id = obj.id || obj.ni;
                    obj.text = obj.text || obj.nome ? obj.nome : obj.nomeUsual;

                    return obj;
                });

                return {
                    results:data,
                    pagination:{
                        more:true
                    }
                };

            }

        }
    });


});

jQuery(function(){

    jQuery('#sidebarCollapse').on('click', function (event) {
        event.preventDefault();
        jQuery('#sidebar').toggleClass('active');
    });

    jQuery('a[href="#painelLinkUsuario"]').on('click', function (event) {
        event.preventDefault();
        var link = jQuery(this).parent();
        if(link.hasClass('in')){
            link.removeClass('in');
        }else{
            link.addClass('in');
        }
    });

    jQuery('a[href="#painelNotificacoes"]').popover({
        title:jQuery('<h2 class="h5 text-info"> Notificações </h2>'),
        html:true,
        placement:'bottom',
        content:jQuery('#modalNotificacoes').html(),
        boundary:'viewport'
    });

    jQuery('[data-toggle="tooltip"]').tooltip();

});


var Form = {

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
            error:function(data) {
                Form.obterRetornoDeErros(data);
            }
        });

    },
    validate:function(formulario,options){
        jQuery.validator.setDefaults({
            debug: false,
            success: "valid",
            ignore: []
        });
      formulario.validate(options);
    },
    valid:function(formulario){
      return formulario.valid();
    },
    obterRetornoDeErros:function(data){

            var mensagens = '';
            var dados = data.responseJSON;

            console.log(dados);

            if(typeof dados.message === 'string') {
                mensagens += dados.message;
            }else{
                mensagens += 'Um problema não identificado!'
            }


            if(typeof dados.errors === 'object' && dados.errors.length > 0) {

                dados.errors.map(function (dados) {

                    if(dados.message) {
                        mensagens += "<div class='text-danger'>" + dados.message + "</div>";
                    }

                    if(!dados.message){
                        mensagens += "<div class='text-danger'>" + dados + "</div>";
                    }

                });
            }

            swal({
                title:'Error',
                html:mensagens,
                type:'error'
            });
        }
};


/**
 * Apresenta um loader utilizando o sweet alert
 *
 * @param message
 * @param texto
 */
function showLoading(message,texto) {
    swal({
        title: message,
        text:texto,
        allowOutsideClick: false,
        type:'info',
        button:false
    });
}

/**
 * Function Set Dados Select Cidade quando editar formulario
 */

function loadCidade(id) {

    var cidade = $(id);
    var options = "<option value=''></option>";
    if(cidade.data('option-value') !=="" && cidade.data('text-value') !=="" ) {

        var id   = cidade.data('option-value');
        var text   = cidade.data('option-text');
        options = '<option value="' + id + '">' + text + '</option>';
    }
        cidade.html(options);
}

/**
 * Através do data-prototype da coleção gerada
 * pelo Symfony/Forms, utilizo esta funçã para criar oscampos
 * conforme o clique do botão (necessário oID do mesmo) e gerar os clones
 *
 * Adicionar + complementos no Formulário Padrão Endereço
 */

var ClonarColecoesFormulario = {


     inicializar : function(botao,conteudo) {

         var $addTagLink = $(botao);
         var $addLinkDiv = $('<div></div>').appendTo($addTagLink);

         var container = $(conteudo);

         container.append($addLinkDiv);


         $addTagLink.on('click', function (e) {
             container.data('index', container.find('fieldset').length);
             e.preventDefault();
             ClonarColecoesFormulario.addForm(container, $addLinkDiv);

         });

     },

     addForm:function(container,link){
             var prototype = container.data('prototype');
             var index = container.data('index');

             var novoFormulario = prototype.replace(/__name__/g,index);

             container.data('index',index+1);

             var newFormLinkRemove = $("<div></div>").append(novoFormulario);
             newFormLinkRemove.append('<a href="#" class="btn btn-danger remover-complemento mt-1 mb-3"><i class="fa fa-window-close"></i> </a>');
             link.before(newFormLinkRemove);

             $('.remover-complemento').on('click',function(e){
                 e.preventDefault();
                 $(this).parent().remove();
                 return false;
             });
         }
};

jQuery(function(){
  ClonarColecoesFormulario.inicializar('#BtnContatos','#forma_contato');
  ClonarColecoesFormulario.inicializar('#AdicionarComplemento','#complemento');
});