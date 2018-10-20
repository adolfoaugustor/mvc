<?php

namespace controllers;

class HomeController extends BaseController {

    public function index()
    {
        $this->view('site/index.php');
    }

    public function store()
    {
        $this->view('site/store.php');
    }

    public function update()
    {
        $this->view('site/update.php');
    }
}
