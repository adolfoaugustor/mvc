<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 24/09/18
 * Time: 17:09
 */

namespace Helpers\FormType\Choices;


use Helpers\Doctrine\EntityManagerHelper;

class TaxaConveniencia
{
    use EntityManagerHelper;

    public function make()
    {
        $taxaConveniencias = $this->getDoctrine()->getRepository(\Sistema\Entity\Financeiro\TaxasConveniencia::class)
                                  ->findAll();
        $params = [];
        /**
         * @var \Sistema\Entity\Financeiro\TaxasConveniencia $taxaConveniencia
         */
        foreach($taxaConveniencias as $taxaConveniencia) {
            $params[$taxaConveniencia->getDescricao()] = $taxaConveniencia->getId();
        }

        return [
            'label'=> 'Taxa Conveniencia ',
            'choices'=> $params,
            'placeholder' => 'Selecione uma opção',
            'attr'=>[
                'class' => ''
            ]
        ];
    }
}