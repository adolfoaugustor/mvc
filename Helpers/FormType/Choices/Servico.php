<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 24/09/18
 * Time: 17:24
 */

namespace Helpers\FormType\Choices;



use Helpers\Doctrine\EntityManagerHelper;

class Servico
{

    use EntityManagerHelper;

    public function make()
    {
        $servicos = $this->getDoctrine()->getRepository(\Rtd\Suporte\Entity\Central\Servico::class)->findAll();

        $params = [];
        /**
         * @var \Rtd\Suporte\Entity\Central\Servico $servico
         */
        foreach($servicos as $servico) {
            $params[$servico->getDescricao()] = $servico->getIdServico();
        }

        return [
            'label'=> 'Serviço',
            'choices'=> $params,
            'placeholder' => 'Selecione uma opção',
            'attr'=>[
                'class' => ''
            ]
        ];
    }
}