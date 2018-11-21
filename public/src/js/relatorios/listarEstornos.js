let $table = Datatables.carregarTabela({
    id:'listarEstornos',
    url:'/financeiro/relatorios/estornos/listar',
    colunas:[
        'id',
        'motivo',
        'deferido',
        'data',
        'descricao',
    ],
    ordem:[0,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-taxas-excluir',$table);