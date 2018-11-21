<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 16:33
 */

namespace Sistema\Beanstalk;

interface ProcessaFilaInterface
{
    /**
     * Configura a pasta dos workes
     * @param str $dir
     * @return self
     */
    public function setWorkerDir($dir);

    /**
     * Configura o namespace
     * @param str $dir
     * @return self
     */
    public function setNamespace($dir);

    /**
     * Processa todos os workers cadastrados
     * @param string $tubo
     * @param integer|null $timeout
     */
    public function processar($tubo, $timeout = null);
}