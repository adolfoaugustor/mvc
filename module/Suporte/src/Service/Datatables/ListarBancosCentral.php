<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarBancosCentralInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarBancosCentral extends ListagemDatatables implements ListarBancosCentralInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
           select b.ni_banco as ni,b.codigo, b.nome from financeiro.bancos b inner join
           financeiro.bancos_central bc ON bc.ni_banco = b.ni_banco
        ");

        $dt->setRowData(function ($bancos) {
            return $bancos;
        });

         $dt->add('acao', function ($bancos) {

            $acoes = [
                new Acao(
                    'bancos-central-deletar',
                    'Desfazer relação',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/bancos-central/deletar/'.$bancos['ni']
                )
            ];

            return implode("\r\n ", $acoes);
        });
    }
}