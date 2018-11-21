<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarCanalDeVendasInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarCanalDeVendas extends ListagemDatatables implements ListarCanalDeVendasInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select ni,identificador,TO_CHAR(data_adesao,'DD-MM-YYYY') as data_adesao, case when ativo then  'Sim' else  'Não' end as ativo, chave from financeiro.canais_de_venda 
        ");

        $dt->setRowData(function ($canal) {
            return $canal;
        });

         $dt->add('acao', function ($canal) {


            $acoes = [

                new Acao(
                    'canal-de-venda-editar',
                    'Editar este Canal de venda',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/canal-de-venda/editar/'.$canal['ni']
                ),
                new Acao(
                    'bancos-deletar',
                    'Remover este banco',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/canal-de-venda/deletar/'.$canal['ni']
                )
            ];

            return implode("\r\n ", $acoes);
        });
    }
}