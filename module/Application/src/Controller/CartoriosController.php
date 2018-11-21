<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 09/10/18
 * Time: 15:56
 */

namespace Rtd\Application\Controller;


use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\PersistentCollection;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\HttpResponse\HttpResponseJson;
use Rtd\Application\Entity\Central\Cartorios;
use Rtd\Application\Entity\Central\Cidades;
use Rtd\Application\Entity\Central\Enderecos;
use Rtd\Application\Entity\Central\Estados;
use Rtd\Application\Entity\Central\Pessoa;
use Zend\Diactoros\Response\JsonResponse;


class CartoriosController
{

    use EntityManagerHelper;

    public function obterPorCidade($id)
    {

        $result = $this->getDoctrine()->createQueryBuilder()
            ->select('p.ni,p.nome,cid.cidadeId,es.estadoId')
            ->from(Cartorios::class,'crt')
            ->join(Pessoa::class,'p','WITH','crt.ni = p.ni')
            ->join(Enderecos::class,'en','WITH','crt.ni = en.ni')
            ->join(Cidades::class,'cid','WITH','en.idCidade = cid.cidadeId')
            ->join(Estados::class,'es','WITH','en.idEstado= es.estadoId')
            ->where('cid.cidadeId = :id')
            ->setParameter('id',$id,Type::INTEGER)
            ->getQuery()->getScalarResult();

        if(count($result) == 0){
            return new JsonResponse([
                'code'=>9999,
                'message'=>'Nenhum cartório encontrado',
            ]);
        }

        return new JsonResponse($result);

    }
}