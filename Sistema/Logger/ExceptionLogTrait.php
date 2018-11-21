<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 11:39
 */

namespace Sistema\Logger;


trait ExceptionLogTrait
{
    public function log()
    {
        if ($this instanceof \Exception) {
            LoggerFactory::make()->getLogger()->warning('Uma exceção ocorreu {message}', [
                'message' => $this->getMessage(),
                'exception' => $this
            ]);
        }
    }
}