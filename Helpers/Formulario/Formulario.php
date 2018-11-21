<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/09/18
 * Time: 10:20
 */

namespace Helpers\Formulario;

use DI\Annotation\Inject;
use DI\Container;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\ValidatorForm\Factory;
use Sistema\Container\Bootstrapper;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

class Formulario implements FormularioInterface
{

    /**
     * @param $url
     * @param $metodo
     * @param string $type
     * @param null $dados
     * @param array $options
     * @return FormBuilderInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws \ReflectionException
     */
    public function obterFormulario(string $url,string $metodo,$type = FormType::class,$dados = null,$options = []):FormBuilderInterface
    {

        $nomeForm = $type;
        $nomeForm = explode('\\',$nomeForm);
        $nomeForm = 'Form'.str_replace('Type','',end($nomeForm));


        $opcoes['attr']['id'] = $options['attr']['id'] ?? $nomeForm;
        $opcoes['attr']['novalidate'] = $options['attr']['novalidate'] ?? 'novalidate';

        $opcoes['csrf_protection'] =  $options['csrf_protection'] ?? true;
        $opcoes['csrf_field_name'] =  $options['csrf_field_name'] ?? '_token';
        $opcoes['csrf_token_id'] = $options['csrf_token_id'] ?? get_class($dados);
        $opcoes['csrf_message'] = 'O CSRF token é inválido. Por favor tente atualizar o formulário!.';

        /**
         * Gera id do Formulario e Nome
         */

        $bootstrap = Bootstrapper::bootstrap();
        $container = $bootstrap->get(Container::class);

        $validacao = Factory::make();

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($container->get(Session::class));
        $csrfManager = new CsrfTokenManager($csrfGenerator,$csrfStorage);


        $forms =Forms::createFormFactoryBuilder();
        $form = $forms->addExtension(new HttpFoundationExtension())
            //->addExtension(new ValidatorExtension($validacao)) ( devido a mudança nos templates, avalidação não será usada)
            ->addExtension(new DependencyInjectionExtension($container,[],[]))
            ->addExtension(new CsrfExtension($csrfManager))
            ->getFormFactory()
            ->createBuilder($type,$dados,$opcoes);

        if($url)
        {
            $form->setAction($url);
        }
        if($metodo)
        {
            $form->setMethod($metodo);
        }

        return $form;
    }


}