<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 30/10/18
 * Time: 13:55
 */

namespace Helpers\Twig;


use Exception;
use function foo\func;
use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Clientes\Entity\Central\Estados;


class HelpersListas
{
    use EntityManagerHelper;

    public function obterEstados($default = null){

       $query ="select * from central.estados";

       return $this->obterLista($query,'estado_id','desc_estado',$default = null);

    }

    public function obterServicos($default = null){
        $query ="select * from central.servicos";
        return $this->obterLista($query,'id_servico','descricao',$default = null);

    }

    public function obterCartorios($default = null){

        $query = "select COALESCE(c.ni,p.ni) as ni,nome from central.cartorios c inner join central.pessoa p ON p.ni = c.ni";

        return $this->obterLista($query,'ni','nome',$default = null);

    }

    private function obterErroListagem(){
        return "<option>Ocorreu um problema na listagem</option>";
    }

    public function  obterTiposDocumentosServicos($default = null){
        $query = "select  id,descricao from central.tipos_documentos_servicos order by descricao ASC";
        return $this->obterLista($query,'id','descricao',$default = null);
    }

    public function  obterVinculosParte($default = 3){
        $query = "select  codigo,descricao from sinter.qualificacao_parte_titulo order by descricao ASC";
        return $this->obterLista($query,'codigo','descricao',$default);
    }



    private function obterLista($query,$campo_id,$campo_valor,$default = null){

        try {
            $stmt = $this->getDoctrine()->getConnection()->query($query)->fetchAll(\PDO::FETCH_CLASS);

            $options = array_map(function ($dados) use($campo_id,$campo_valor,$default) {

                $selected = '';

                if($dados->{$campo_id} === $default){
                    $selected  = 'selected';
                }

                return "<option $selected value='{$dados->{$campo_id}}'>{$dados->{$campo_valor}}</option>";
            }, $stmt);

            return join('',$options);

        }catch (Exception $e){
            return $this->obterErroListagem();
        }

    }

}
