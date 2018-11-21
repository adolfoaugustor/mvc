<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;

use Rtd\Suporte\Service\Datatables\Interfaces\ListarFormasContatoInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarFormasContato extends ListagemDatatables implements ListarFormasContatoInterface
{

    private $dados = [];

    public function setDados($dados = []){
        $this->dados = $dados;
    }

    protected function configurarDatatables(Datatables $dt)
    {

        $params = [];
        $query = "
            select id,tipo,identificador,ni from central.forma_contatos 
        ";

        if(count($this->dados) > 0){
            if(key_exists('ni',$this->dados)){
                $query.=" where ni = :ni ";
                $params[':ni'] = $this->dados['ni'];
            }
        }

        $query .=" order by id DESC";

        $dt->query($query);


        $dt->setRowData(function ($pessoas) {
            return $pessoas;
        });

        $dt->bindParams($params);

         $dt->add('acao', function ($pessoas) {

            $acoes = array(
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'forma-contato-editar',
                    'Editar este contato',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/pessoa/forma-contato/editar/'.$pessoas['id']
                ),
                new Acao(
                    'forma-contato-excluir',
                    'Excluir este contato',
                    'fas fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/pessoa/forma-contato/excluir/'.$pessoas['id']
                )
            );
            return implode("\r\n ", $acoes);
        });
    }
}