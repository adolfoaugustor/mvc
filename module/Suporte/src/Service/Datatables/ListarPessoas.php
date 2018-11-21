<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;


use Rtd\Suporte\Service\Datatables\Interfaces\ListarPesssoasInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarPessoas extends ListagemDatatables implements ListarPesssoasInterface
{
    protected function configurarDatatables(Datatables $dt)
    {
        $dt->query("
            select p.ni,p.nome from central.pessoa p
        ");

        $dt->setRowData(function ($pessoas) {
            return $pessoas;
        });

         $dt->add('acao', function ($pessoas) {


            $acoes = [
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'pessoa-editar',
                    'Detalhes do Documento',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/pessoa/editar/'.$pessoas['ni']
                ),
                new Acao(
                    'formas-contato',
                    'Visualizar Contatos',
                    'fa fa-phone-square',
                    'btn btn-info text-light',
                    '/suporte/pessoa/forma-contato/ni/'.$pessoas['ni']
                ),
                new Acao(
                    'visualizar-enderecos',
                    'Visualisar Endereços',
                    'fas fa-address-book text-light',
                    'btn btn-warning text-light',
                    '/suporte/pessoa/enderecos/ni/'.$pessoas['ni']
                ),
                new Acao(
                    'pessoa-deletar',
                    'Remover esta pessoa!',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/pessoa/deletar/'.$pessoas['ni']
                )
            ];

            $ni = preg_replace('/[\D]/','',$pessoas['ni']);

            if(strlen($ni) === 11) {

                $fisica = new Acao(
                    'pessoa-editar-dados',
                    'Editar Pessoa Física',
                    'fa fa-user text-light',
                    'btn btn-dark text-light',
                    '/suporte/pessoa/fisica/editar/' . $pessoas['ni']
                );


                array_push($acoes, $fisica);
            }

            if(strlen($ni) === 14) {
                $juridica = new Acao(
                    'pessoa-editar-dados',
                    'Editar Pessoa Jurídica',
                    'fa fa-user text-light',
                    'btn btn-dark text-light',
                    '/suporte/pessoa/juridica/editar/' . $pessoas['ni']
                );

                array_push($acoes, $juridica);
            }

            return implode("\r\n ", $acoes);
        });
    }
}