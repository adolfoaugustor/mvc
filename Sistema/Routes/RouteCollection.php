<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/01/18
 * Time: 09:08
 */

namespace Sistema\Routes;

use League\Route\Middleware\ExecutionChain;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sistema\Routes\ServerRequestRouteDecorator;

class RouteCollection extends \League\Route\RouteCollection
{
    /**
     * @inheritDoc
     */
    public function dispatch(ServerRequestInterface $request, ResponseInterface $response)
    {
        $dispatcher = $this->getDispatcher($request);
        $match = $dispatcher->match($request);
        if ($match->getStatus() === Match::FOUND) {
            $route = $match->getRoute();
            $request = new ServerRequestRouteDecorator($request, $route);
        }

        $execChain = $dispatcher->getExecutionChain($match);

        foreach ($this->getMiddlewareStack() as $middleware) {
            $execChain->middleware($middleware);
        }

        try {
            return $execChain->execute($request, $response);
        } catch (\Exception $exception) {
            $middleware = $this->getStrategy()->getExceptionDecorator($exception);
            return (new ExecutionChain)->middleware($middleware)->execute($request, $response);
        } catch (\Throwable $error) {
            $exception = new \Exception($error->getMessage(), $error->getCode(), $error);
            $middleware = $this->getStrategy()->getExceptionDecorator($exception);
            return (new ExecutionChain)->middleware($middleware)->execute($request, $response);
        }
    }

    public function getDispatcher(ServerRequestInterface $request)
    {
        if (is_null($this->getStrategy())) {
            $this->setStrategy(new ApplicationStrategy);
        }

        $this->prepRoutes($request);

        return (new Dispatcher($this->getData()))->setStrategy($this->getStrategy());
    }
}