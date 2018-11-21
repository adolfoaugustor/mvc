<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;


use Helpers\Doctrine\EntityManagerHelper;



class Pais
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(\Rtd\Suporte\Entity\Central\Pais::class)->findAll();

        $paises = [];
        /**
         * @var \Rtd\Suporte\Entity\Central\Pais $pais
         */
        foreach($query as $pais){
            $paises[$pais->getDescricao()]=$pais->getDescricao();
        }

        $dados =  [

                'label'=>'País',
                'choices'=>$paises,
                 'placeholder'=> 'Selecione um país',
                'attr'=>[
                    'class'=>''
                ]
            ];

        return $dados;
    }
}