let $table = Datatables.carregarTabela({
    id:'listarReceitas',
    url:'/financeiro/relatorios/receitas/listar',
    colunas:[
        'id',
        'descricao',
        'data',
        'ni_cliente',
        'ni_canal_de_venda'
    ],
    ordem:[0,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-receitas-excluir',$table);