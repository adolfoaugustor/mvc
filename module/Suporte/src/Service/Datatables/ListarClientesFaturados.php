<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */
namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarClientesFaturadosInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarClientesFaturados extends ListagemDatatables implements ListarClientesFaturadosInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select ni,to_char(data_adesao,'DD-MM-YYYY') as data_adesao,dia_fechamento_fatura,periodicidade_fatura from financeiro.clientes_faturados
        ");

        $dt->setRowData(function ($bancos) {
            return $bancos;
        });

         $dt->add('acao', function ($clientes) {


            $acoes = [

                new Acao(
                    'clientes-faturados-editar',
                    'Editar este Cliente Faturado',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/clientes-faturados/editar/'.$clientes['ni']
                ),
                new Acao(
                    'clientes-faturados-deletar',
                    'Remover este banco',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/clientes-faturados/deletar/'.$clientes['ni']
                ),
                new Acao(
                    'Detalhes do cliente',
                    'Ver detalhes do cliente',
                    'fas fa-file',
                    'btn btn-warning text-light',
                    '/suporte/clientes-faturados/'.$clientes['ni'].'/fatura'
                )
            ];

            return implode("\r\n ", $acoes);
        });
    }
}