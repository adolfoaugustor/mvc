<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/09/18
 * Time: 09:09
 */

namespace Helpers\Breadcrumbs;

use Creitive\Breadcrumbs\Breadcrumbs;
use DI\Annotation\Injectable;

/**
 * Class GuiaDeNavegacao
 * @package Sistema\Servico\Breadcrumbs
 */
class GuiaDeNavegacao extends Breadcrumbs implements GuiaDeNavegacaoInterface
{

    public function __construct(array $breadcrumbs = array(), array $cssClasses = array())
    {
        parent::__construct($breadcrumbs, $cssClasses);

        $this->setListItemCssClass('breadcrumb-item');
        $this->setCssClasses('breadcrumb mt-3');
        $this->setDivider(' ');
        $this->setListElement('ul');

    }

    public function adicionar($nome,$url,$fullurl = false)
    {
      return $this->add($nome, $url, $fullurl);

    }

    public function renderizar()
    {
      return $this->render();
    }

}