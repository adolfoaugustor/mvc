<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 26/10/18
 * Time: 10:47
 */

namespace Helpers\GeneratePdf\Interfaces;

interface GeneratePdfHelperInterface
{
    /**
     * @param string $file
     * @return mixed
     */
    public function loadTemplate(string $file);

    /**
     * @param array $dados
     * @return mixed
     */
    public function getContentToHtml(array $dados = []);

    /**
     * @param string $html
     * @return mixed
     */
    public function renderPdfForBrowser(string $html);
}