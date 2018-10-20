<?php

namespace controllers;

class PostController extends BaseController
{
    public function index()
    {
        $this->view('site/posts/index.php');
    }

    public function store()
    {
        $this->view('site/posts/store.php');
    }

    public function update()
    {
        $this->view('site/posts/update.php');
    }
}
