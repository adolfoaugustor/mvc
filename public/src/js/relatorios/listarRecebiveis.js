let $table = Datatables.carregarTabela({
    id:'listarRecebiveis',
    url:'/financeiro/relatorios/recebiveis/listar',
    colunas:[
        'id',
        'periodo',
        'receita',
        'a_menor',
        'a_maior'
    ],
    ordem:[2,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-receitas-excluir',$table);