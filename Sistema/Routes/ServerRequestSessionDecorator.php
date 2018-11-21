<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 12:55
 */

namespace Sistema\Routes;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class ServerRequestSessionDecorator extends ServerRequestDecorator
{
    /**
     * @var Session
     */
    protected $session;

    public function __construct(ServerRequestInterface $request, Session $session)
    {
        parent::__construct($request);
        $this->session = $session;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }
}