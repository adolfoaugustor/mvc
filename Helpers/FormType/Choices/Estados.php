<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Central\Estados as Estado;
use Sistema\Container\Bootstrapper;


class Estados
{
    use EntityManagerHelper;

    public function make(){

        $query = $this->getDoctrine()->getRepository(Estado::class)->findAll();

        $estados = [];

        foreach($query as $estado){
            $estados[$estado->getDescEstado()]=$estado->getEstadoId();
        }

        return [
                'label'=>'Estado',
                'choices'=>$estados,
                'attr'=>[
                    'class'=>'estado-select-2'
                ]
            ];
    }
}