<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;



use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Suporte\Entity\Central\TipoComplemento;

class TiposComplementos
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(TipoComplemento::class)->findAll();

        /**
         * @var \Sistema\Entity\Central\Pais $pais
         */
        $tipos = [];
       foreach($query as $tipoComplemento){
           $tipos[$tipoComplemento->getDescricao()] = $tipoComplemento->getDescricao();
       }


        $dados =  [

                'label'=>'Tipo de complemento',
                'choices'=> $tipos,
            ];

        return $dados;
    }
}