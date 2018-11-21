<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 05/10/18
 * Time: 11:09
 */

namespace Rtd\Application\Controller;

use Sistema\AbstractController\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        return $this->view('application/index/index.twig');
    }
}