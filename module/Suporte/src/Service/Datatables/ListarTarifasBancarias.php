<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarTarifasBancariasInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarTarifasBancarias extends ListagemDatatables implements ListarTarifasBancariasInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select id,descricao from financeiro.tarifas_bancarias
        ");

        $dt->setRowData(function ($tarifasBancarias) {
            return $tarifasBancarias;
        });

         $dt->add('acao', function ($tarifasBancarias) {


            $acoes = [

                new Acao(
                    'tarifas-bancarias-editar',
                    'Editar esta Tarifa Bancária',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/tarifas-bancarias/editar/'.$tarifasBancarias['id']
                ),
                new Acao(
                    'tarifas-bancarias-deletar',
                    'Remover esta Tarifa Bancária',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/tarifas-bancarias/deletar/'.$tarifasBancarias['id']
                )
            ];

            return implode("\r\n ", $acoes);
        });
    }
}