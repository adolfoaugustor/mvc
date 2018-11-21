<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarServicosInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarServicos extends ListagemDatatables implements ListarServicosInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select id_servico,descricao,sigla,tabela_dados from central.servicos
        ");

        $dt->setRowData(function ($servico) {
            return $servico;
        });

         $dt->add('acao', function ($servico) {

            $acoes = array(
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'servico-editar',
                    'Editar Serviço',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/servico/editar/'.$servico['id_servico']
                ),
                new Acao(
                    'servico-excluir',
                    'Excluir Serviço',
                    'fa fa-trash',
                    'btn btn-danger text-light',
                    '/suporte/servico/deletar/'.$servico['id_servico']
                )
            );
            return implode("\r\n ", $acoes);
        });
    }
}