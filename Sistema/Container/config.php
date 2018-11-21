<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 01/12/17
 * Time: 09:35
 */

namespace Sistema\Container;

use \Symfony\Component\HttpFoundation\Request;

return [
    // HTTP FOUNDATION
    Request::class => function () {
        return Request::createFromGlobals();
    },
];