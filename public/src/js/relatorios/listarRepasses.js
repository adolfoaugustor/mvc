let $table = Datatables.carregarTabela({
    id:'listarRepasses',
    url:'/financeiro/relatorios/repasses/listar',
    colunas:[
        'data_efetivacao',
        'individuo',
        'nome',
        'ni'
    ],
    ordem:[0,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-repasses-excluir',$table);