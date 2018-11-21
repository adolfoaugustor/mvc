<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:39
 */

namespace Rtd\Suporte\Service\Datatables;



use Rtd\Suporte\Service\Datatables\Interfaces\ListarEnderecosInterface;
use Sistema\Datatables\Acao\Acao;
use Sistema\Datatables\Datatables;
use Sistema\Datatables\ListagemDatatables;

class ListarPessoasEndereco extends ListagemDatatables implements ListarEnderecosInterface
{

    private $dados;

    /**
     * @param mixed $dados
     */
    public function setDados(array $dados): void
    {
        $this->dados = $dados;
    }

    protected function configurarDatatables(Datatables $dt)
    {

        $query = "select e.id_endereco ,e.ni,e.nome,e.tipo,e.numero,e.bairro,c.desc_cidade ,es.desc_estado, CASE  when e.endereco_ativo then 'ativo'::text else 'inativo'::text end as endereco_ativo
	    from central.enderecos e 
		left join central.cidades c on c.cidade_id = e.id_cidade
		left join central.estados es on es.estado_id = e.id_estado ";


        if(count($this->dados) > 0){

            $query.=" where ni = :ni ";
        }


        $dt->query($query);


        if(count($this->dados) > 0){
            $dt->bindParams([
                ':ni' => $this->dados['ni']
            ]);
        }

        $dt->setRowData(function ($pessoas) {
            return $pessoas;
        });


         $dt->add('acao', function ($pessoas) {
            $acoes = array(
                //new Acao('excluir', 'Visualizar Documento', 'fa fa-times-circle','btn btn-danger text-light'),
                new Acao(
                    'endereco-editar',
                    'Editar este endereço',
                    'fa fa-edit',
                    'btn btn-primary text-light',
                    '/suporte/pessoa/endereco/editar/'.$pessoas['id_endereco']
                ),
                new Acao(
                    'visualizar-complementos',
                    'Ver complementos',
                    'fa fa-list',
                    'btn btn-warning text-light',
                    '/suporte/pessoa/endereco/'.$pessoas['id_endereco'].'/complementos'
                ),
                new Acao(
                    'excluir-endereco',
                    'Excluir este endereço',
                    'fas fa-trash text-light',
                    'btn btn-danger text-light',
                    '/suporte/pessoa/endereco/excluir/'.$pessoas['id_endereco']
                )
            );
            return implode("\r\n ", $acoes);
        });
    }
}