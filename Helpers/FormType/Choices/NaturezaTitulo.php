<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;

use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Sinter\NaturezaTitulo as NT;

class NaturezaTitulo
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(NT::class)->findAll();

        /**
         * @var \Application\Entity\Sinter\NaturezaTitulo $naturezaTitulo
         */
        $tipos = [];
       foreach($query as $naturezaTitulo){
           $tipos[$naturezaTitulo->getDescricao()] = $naturezaTitulo->getDescricao();
       }

        $dados =  [
                'label'       => 'Natureza Título',
                'placeholder' => '-- Selecione a natureza titulo --',
                'choices'     => $tipos,
            ];

        return $dados;
    }
}