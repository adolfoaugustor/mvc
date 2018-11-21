<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 17/10/18
 * Time: 14:08
 */

namespace Helpers\Utils;


trait MathTrait
{
    public function convertCurrencyBRLToEUA(string $currency) : float
    {
        return (float) str_replace(['.', ','], ['', '.'], $currency);
    }
}