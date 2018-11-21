<?php

/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;

use Rtd\Suporte\Service\Datatables\Interfaces\ListarComplementosInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarComplementos extends ListagemDatatables implements ListarComplementosInterface
{

    private $id_endereco = null;


    /**
     * @param $id_endereco
     */
    public function setIdEndereco($id_endereco): void
    {
        $this->id_endereco = $id_endereco;
    }

    /**
     * @param Datatables $dt
     */
    protected function configurarDatatables(Datatables $dt)
    {
        $query = "select p.id,p.tipo,p.identificacao,p.id_endereco from central.complementos p";

        $params = [];

        if(!is_null($this->id_endereco)){
            $query.=" WHERE p.id_endereco = :id_endereco ";
            $params[':id_endereco'] = $this->id_endereco;
        }

        $dt->query($query);
        $dt->bindParams($params);

        $dt->setRowData(function ($complemento) {
            return $complemento;
        });

         $dt->add('acao', function ($complemento) {

            $acoes = array(
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'complemento-editar',
                    'Detalhes do Complemento',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/pessoa/endereco/complemento/editar/'.$complemento['id']
                ),

                new Acao(
                    'complemento-excluir',
                    'Excluir este complemento',
                    'fa fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/pessoa/endereco/complemento/deletar/'.$complemento['id']
                )
            );
            return implode("\r\n ", $acoes);
        });
    }
}