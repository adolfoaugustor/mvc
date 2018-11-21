<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 05/10/18
 * Time: 11:41
 */

namespace Helpers\Formulario\Interfaces;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;

interface FormularioInterface
{
    public function obterFormulario(string $url, string $metodo, $type = FormType::class, $dados = null, $options = []) : FormBuilderInterface;
}