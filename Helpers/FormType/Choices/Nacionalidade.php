<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;


use Helpers\Doctrine\EntityManagerHelper;

class Nacionalidade
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = self::getDoctrine()->getRepository(\Rtd\Suporte\Entity\Central\Nacionalidade::class)->findAll();

        $nacionalidades = [];
        /**
         * @var \Sistema\Entity\Central\Nacionalidade $nacionalidade
         */
        foreach($query as $nacionalidade){
            $nacionalidades[$nacionalidade->getDescricao()]=$nacionalidade->getDescricao();
        }

        $dados =  [
                'label'=>'Nacionalidade',
                'choices'=>$nacionalidades,
                 'placeholder'=> 'Selecione uma nacionalidade',
                'attr'=>[
                    'class'=>''
                ],
            ];

        return $dados;
    }
}