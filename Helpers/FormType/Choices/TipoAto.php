<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;

use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Sinter\TipoAto as T;

class TipoAto
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(T::class)->findAll();

        /**
         * @var \Application\Entity\Sinter\TipoAtoRtd $descricao
         */
        $tipos = [];
       foreach($query as $tipoDecricao){
           $tipos[$tipoDecricao->getDescricao()] = $tipoDecricao->getDescricao();
       }

        $dados =  [
                'label'=>'Tipo ato',
                'placeholder' => '-- Selecione o tipo ato --',
                'choices'=> $tipos,
            ];

        return $dados;
    }
}