<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 31/08/18
 * Time: 17:35
 */

namespace Helpers\FormType;



use Helpers\Formulario\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;


class PessoaAutoCompleteType extends FormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        return $builder
            ->add('ni',ChoiceType::class,[
                'label'=>'Pessoa',
                'required'=>true,
                'attr'=>[
                    'class'=>'select2-ajax-pessoa'
                ]
            ]);

    }

}