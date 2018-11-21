<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 03/09/18
 * Time: 09:28
 */

namespace Helpers\Formulario;

use DI\Annotation\Inject;
use DI\Container;
use Doctrine\ORM\EntityManager;
use Sistema\Container\Bootstrapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType
{

    /**
     * @Inject()
     * @var EntityManager
     *
     */
    private  $doctrine;


    public function  getBlockPrefix(){

        return null;

    }

    protected function getDoctrine(){
        return $this->doctrine;
    }


}