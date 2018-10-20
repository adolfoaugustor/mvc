<?php

namespace controllers;

class BaseController {

    public function view($path)
    {
        include '../views/'.$path;
    }
}
