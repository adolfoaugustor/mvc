let $table = Datatables.carregarTabela({
    id:'listarPagamentos',
    url:'/financeiro/relatorios/pagamentos/listar',
    colunas:[
        'ni_cliente',
        'descricao',
        'data_pagamento'
    ],
    ordem:[0,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-valores-excluir',$table);