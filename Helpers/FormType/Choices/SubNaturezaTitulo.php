<?php
/**
 * Created by PhpStorm.
 * User: ivini
 * Date: 04/09/18
 * Time: 20:42
 */

namespace Helpers\FormType\Choices;

use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Application\Entity\Sinter\SubNaturezaTitulo as SN;

class SubNaturezaTitulo
{
    use EntityManagerHelper;

    public function make($data = ''){

        $query = $this->getDoctrine()->getRepository(SN::class)->findAll();

        /**
         * @var \Application\Entity\Sinter\SubNaturezaTitulo $subNaturezaTitulo
         */
        $tipos = [];
       foreach($query as $subNaturezaTitulo){
           $tipos[$subNaturezaTitulo->getDescricao()] = $subNaturezaTitulo->getDescricao();
       }

        $dados =  [
                'label'       => 'Sub Natureza Título',
                'placeholder' => '-- Selecione a sub natureza titulo --',
                'choices'     => $tipos,
            ];

        return $dados;
    }
}