var Datatables = (function () {

    var jq = ( !$ ) ? jQuery : $;

    /**
     * Carrega Datatables numa tabela
     * @param opcoes Objeto com os parametros:
     *
     *  - id: Id da tabela (string)
     *  - colunas: array com o nome das colunas
     *  - aoColumnDefs: array de configurações das colunas, utilizando o aoColumnDefs do Datatables
     *  - url: Url da requisicao ajax
     *  - delay: Delay em ms para o debounce (opcional, padrao 200ms)
     *  - ordem: Array de arrays, default: [[0, 'asc']]
     *  - dados: Função callback, usada para adicionar dados extras à requisição
     */
    var carregarTabela = function (opcoes) {


        var idTabela = opcoes.id;
        var colunas = opcoes.colunas;
        var delay = opcoes.delay || 200;
        var url = opcoes.url;
        var ordem = opcoes.ordem || [[3, 'asc']];
        var dados = opcoes.dados || function () {};
        var buttons = opcoes.buttons || [];
        var extra = opcoes.extra || {};
        var aoColumnDefs = opcoes.aoColumnDefs || [];


        var $tabela = jQuery(document).find('#' + idTabela);

        colunas = colunas.map(function (coluna) {
            return {
                data: coluna
            };
        });

        /**
         *  Configuração padrão para aoColumnDefs
         */

        var configColunaNaoOrdenada = {
            'bSortable': false,
            'aTargets': ['nosort']
        };

        aoColumnDefs.push(configColunaNaoOrdenada);

        extra.aoColumnDefs  = [];
        extra.aoColumnDefs = aoColumnDefs;

        console.log(extra);

        var padrao = {

            language: {
                url: "/src/js/traducao/br-table.json",

                processing:"<i class='fa fa-spinner fa-spin'></i> Carregando dados..."
            },
            serverSide: true,
            ajax: {
                url: url,
                type: 'GET',
                data: dados
            },
            columns: colunas,
            destroy:true,
            order: ordem,
            dom: 'Bfrtip',
            buttons: buttons,
            aoColumnDefs:aoColumnDefs,
            processing:true,
            initComplete: function () {
                configurarDelay(idTabela, delay, true);
            }
        };




        var customizado = $.extend(padrao, extra);

        return $tabela.DataTable(customizado);
    };

    var debounce = function (func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    var configurarDelay = function (id, delay) {

        var $input = jQuery('#' + id + '_filter input');
        var dataTable = jQuery('#' + id).DataTable();

        $input.off();

        $input.on('keyup', debounce(function () {

            var search = $input.val();

            /**
             * Se o termo for maior que três caracters faz a busca
            */
            //
            // if(search.length > 1) {
            // }
                dataTable.search(search).draw();

        }, delay));
    };


    return {
        carregarTabela: carregarTabela
    };
})();