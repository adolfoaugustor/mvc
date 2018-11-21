let $table = Datatables.carregarTabela({
    id:'listarTaxasCusta',
    url:'/financeiro/relatorios/taxas-custa/listar',
    colunas:[
        'id',
        'automatizada',
        'vigencia',
        'sigla',
        'desc_cidade',
        'cns',
        'descricao'
    ],
    ordem:[2,'desc'],
    buttons:[
        'pdf','csv'
    ],
});

$table.draw();

// Crud.deletar('.acao-taxas-custa-excluir',$table);