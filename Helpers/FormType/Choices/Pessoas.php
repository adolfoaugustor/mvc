<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;


use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Suporte\Entity\Central\Pessoa;

class Pessoas
{

    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(Pessoa::class)->findAll();

        $paises = [];
        /**
         * @var Pessoa $pais
         */
        foreach($query as $pais){
            $paises[$pais->getNome() ?? $pais->getNomeUsual() ]=$pais->getNi();
        }

        $dados =  [
                'label'=>'Pessoa',
                'choices'=>$paises,
                'attr'=>[
                    'class'=>'select2-pessoas-ajax'
                ],
                'data'=>$data
            ];

        return $dados;
    }
}