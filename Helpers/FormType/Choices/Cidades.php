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
use Rtd\Application\Entity\Central\Cidades;
use Sistema\Container\Bootstrapper;

class Cidades
{
    use EntityManagerHelper;

    public function make($cidade){


        $cidade = $this->getDoctrine()->getRepository(Cidades::class)->find($cidade);

        $cidades = $this->getDoctrine()->getRepository(Cidades::class)->findBy(['estado'=>$cidade->getEstado()]);

        $choices = [];
        /**
         * @var Cidades $cidade
         */
        foreach($cidades as $cidade){
            $choices[$cidade->getDescCidade()]=$cidade->getCidadeId();
        }

        return [
        'label'=>'Cidade',
                'attr'=>[
                'id'=>'idCidade',
                'required'=>'required',
        ],
                'choices' => $choices,
                'preferred_choices' => [$cidade->getCidadeId()]
        ];

    }
}