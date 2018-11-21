<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;



use Helpers\Doctrine\EntityManagerHelper;

class EstadoCivil
{

    use EntityManagerHelper;

    public function make(){


        $estado = $this->getDoctrine()->getRepository(\Rtd\Application\Entity\Central\EstadoCivil::class)->findAll();

        $params = [];

        foreach($estado as $estadoCivil) {
            $params[$estadoCivil->getDescricao()] = $estadoCivil->getDescricao();
        }

        return [
            'label'=>'Estado Civil',
            'choices'=>$params,
            'placeholder'=>'Selecione uma opção',
            'attr'=>[
                'class'=>''
            ]
        ];
    }
}