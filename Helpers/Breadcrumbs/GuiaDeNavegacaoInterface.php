<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/09/18
 * Time: 09:07
 */

namespace Helpers\Breadcrumbs;

interface GuiaDeNavegacaoInterface
{
    public function adicionar($nome,$url,$fullurl = false);
    public function renderizar();

}