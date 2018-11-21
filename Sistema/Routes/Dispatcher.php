<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/01/18
 * Time: 09:30
 */

namespace Sistema\Routes;

use League\Route\Middleware\ExecutionChain;
use League\Route\Route;
use Psr\Http\Message\ServerRequestInterface;
use Sistema\Routes\MatchInterface;

class Dispatcher extends \League\Route\Dispatcher
{
    /**
     * @param ServerRequestInterface $request
     * @return Match
     */
    public function match(ServerRequestInterface $request)
    {
        $match = $this->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        return new Match($match);
    }

    /**
     * Obtém a cadeia de execução do roteador
     *
     * @param MatchInterface $match
     * @return ExecutionChain
     */
    public function getExecutionChain(MatchInterface $match)
    {
        switch ($match->getStatus()) {
            case MatchInterface::NOT_FOUND:
                return $this->handleNotFound();

            case MatchInterface::METHOD_NOT_ALLOWED:
                return $this->handleNotAllowed($match->getAllowedMethods());

            default:
                return $this->handleRoute($match->getRoute(), $match->getRouteArguments());
        }
    }

    /**
     * @param Route $route
     * @param array $vars
     * @return ExecutionChain
     */
    protected function handleRoute(Route $route, array $vars)
    {
        $execChain = $route->getExecutionChain($vars);
        return $execChain;
    }
}