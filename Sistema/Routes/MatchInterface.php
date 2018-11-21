<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/01/18
 * Time: 09:41
 */

namespace Sistema\Routes;

interface MatchInterface
{
    const NOT_FOUND = 0;
    const FOUND = 1;
    const METHOD_NOT_ALLOWED = 2;

    public function getStatus();
    public function getRoute();
    public function getRouteArguments();
    public function getAllowedMethods();
}