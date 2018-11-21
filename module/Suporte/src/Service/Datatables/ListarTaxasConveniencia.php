<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarTaxasConvenienciaInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarTaxasConveniencia extends ListagemDatatables implements ListarTaxasConvenienciaInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select id,descricao,
                CASE WHEN
                    percentual 
                        THEN 
                            'sim'
                        ELSE 
                            'Não'
                        END as percentual
                FROM financeiro.taxas_conveniencia      
        ");

        $dt->setRowData(function ($servico) {
            return $servico;
        });

        $dt->add('acao', function ($servico) {

            $acoes = array(
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'taxa-conveniencia-editar',
                    'Editar Taxa de Conveniência',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/taxa-conveniencia/editar/'.$servico['id']
                ),
                new Acao(
                    'taxa-conveniencia-excluir',
                    'Excluir Taxa de Conveniência',
                    'fa fa-trash',
                    'btn btn-danger text-light',
                    '/suporte/taxa-conveniencia/deletar/'.$servico['id']
                )
            );
            return implode("\r\n ", $acoes);
        });
    }
}