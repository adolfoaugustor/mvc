<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarBancosInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarBancos extends ListagemDatatables implements ListarBancosInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select b.ni_banco as ni, b.codigo as codigo, b.nome as nome  from financeiro.bancos b
        ");

        $dt->setRowData(function ($bancos) {
            return $bancos;
        });

         $dt->add('acao', function ($bancos) {


            $acoes = [
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'bancos-editar',
                    'Editar este Banco',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/bancos/editar/'.$bancos['ni']
                ),
                new Acao(
                    'bancos-deletar',
                    'Remover este banco',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/bancos/deletar/'.$bancos['ni']
                )
            ];

            return implode("\r\n ", $acoes);
        });
    }
}