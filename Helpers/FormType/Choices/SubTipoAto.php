<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;

use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Sinter\SubTipoAto as ST;

class SubTipoAto
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(ST::class)->findAll();

        /**
         * @var \Application\Entity\Sinter\SubTipoAtoRtd $subTipoDecricao
         */
        $tipos = [];
       foreach($query as $subTipoDecricao){
           $tipos[$subTipoDecricao->getDescricao()] = $subTipoDecricao->getDescricao();
       }

        $dados =  [
                'label'       =>'Sub tipo ato',
                'placeholder' => '-- Selecione o sub tipo ato --',
                'choices'     => $tipos,
            ];

        return $dados;
    }
}