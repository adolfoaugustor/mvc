
// script da função "validarData()" sendo chamada no layout multas.twig
$('#filtroMultas').on('submit', function (e) {
    e.preventDefault();
    var dataInicial = $("#filtroMultas input[name=data1]").val();
    var dataFinal = $("#filtroMultas input[name=data2]").val();

    let validar = validarData(dataInicial, dataFinal);

    if (validar) {
        $url = $(this).serialize();
        $url = '/financeiro/relatorios/multas/listar?' + $url;
        listarMultas($url);

        $('#filtroMultas')[0].reset();
        return false;
    }
});


function listarMultas(url = ''){

    if(url===''){
        url = '/financeiro/relatorios/multas/listar';
    }

    let $table = Datatables.carregarTabela({
        id:'listarMultas',
        url:url,
        colunas:[
            'nome',
            'descricao',
            'observacao',
            'valor',
            'protocolo'
        ],
        ordem:[1,'desc'],
        buttons:[
            'pdf','csv'
        ],
    });
    $table.draw();
}

listarMultas();


// Crud.deletar('.acao-taxas-excluir',$table);