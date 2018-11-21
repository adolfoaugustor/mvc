let $table = Datatables.carregarTabela({
    id:'listarServicoBusca',
    url:'/cartorio/servico-de-busca/listar',
    colunas:[
        'id',
        'ni_cliente',
        'data',
        'acao'
    ],
    ordem:[0,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-taxas-excluir',$table);