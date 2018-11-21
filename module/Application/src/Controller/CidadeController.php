<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 09/10/18
 * Time: 15:56
 */

namespace Rtd\Application\Controller;


use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Central\Cidades;
use Rtd\Application\Entity\Central\Estados;
use Zend\Diactoros\Response\JsonResponse;

class CidadeController
{

    use EntityManagerHelper;


    public function porEstado($id)
    {
        $estado = $this->getDoctrine()->find(Estados::class,$id);

        $cidades = $this->getDoctrine()->getRepository(Cidades::class)->findBy(['estado'=>$estado]);

        $result = array_map(function(Cidades $cidade){
            $cidades = [];
            return $cidades[] =[
                'cidade_id'=>$cidade->getCidadeId(),
                'desc_cidade'=>$cidade->getDescCidade()
            ];

        },$cidades);

        return  new JsonResponse([
                'code'=>200,
                'message'=>'Lista de cidades',
                'dados'=>$result,
                'request'=>$_REQUEST]
        );
    }

    public function obterPorId($cidade){

        $cidade = $this->getDoctrine()->getRepository(Cidades::class)->find($cidade);

        //var_dump($cidades);

        if(is_null($cidade)){
            return new JsonResponse([
                'code'=>400,
                'message'=>"Cidade com #$cidade não encontrada",
                'dados'=>[],
                'request'=>$_REQUEST
            ],400);
        }

        $result = [
            'cidade_id'=>(int) $cidade->getCidadeId(),
            'desc_cidade'=> $cidade->getDescCidade()
        ];

        return  new JsonResponse([
                'code'=>200,
                'message'=>'Lista de cidades',
                'dados'=>$result,
                'request'=>$_REQUEST
            ]
        );
    }

}