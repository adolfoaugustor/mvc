<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 25/01/18
 * Time: 12:59
 */

namespace Sistema\Strategy;


use DI\Container;
use Exception;
use Franzl\Middleware\Whoops\WhoopsRunner;
use function getenv;
use League\Route\Http\Exception\ForbiddenException;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\Exception\UnauthorizedException;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sistema\Twig\Template\ProcessaTemplateTwig;
use League\Route\Route;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

/**
 * Estratégia de resolução de controllers e manipulação de erros
 */
class CentralStrategy extends ApplicationStrategy
{
    /**
     * @param Route $route
     * @param array $vars
     * @return callable|\Closure
     */
    public function getCallable(Route $route, array $vars)
    {
        return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($route, $vars) {
            $container = $route->getContainer();
            $callable = $route->getCallable();

            // Caso esteja com container DI, vou injetar as dependências lá
            if ($container instanceof Container) {
                if (is_object($callable)) {
                    $container->injectOn($callable);
                }

                $vars['request'] = $request;
                $vars['response'] = $response;
                $response = $container->call($callable, $vars);
            } else {
                $response = call_user_func_array($callable, [$request, $response, $vars]);
            }

            if (! $response instanceof ResponseInterface) {
                throw new RuntimeException(
                    'Route callables must return an instance of (Psr\Http\Message\ResponseInterface)'
                );
            }

            return $next($request, $response);
        };
    }

    /**
     * Retorna decorator do erro de não encontrado
     *
     * @param NotFoundException $exception
     * @return callable
     */
    public function getNotFoundDecorator(NotFoundException $exception)
    {
        return $this->buildExceptionDecorator($exception, 404);
    }

    /**
     * Retorna decorator do erro de método não permitido
     *
     * @param MethodNotAllowedException $exception
     * @return callable
     */
    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception)
    {
        return $this->buildExceptionDecorator(new NotFoundException('Not Found', $exception), 404);
    }

    /**
     * Retorna decorator para erros internos
     *
     * @param Exception $exception
     * @return callable
     */
    public function getErrorDecorator(Exception $exception)
    {

        if ('dev' === getenv('SISTEMA_ENV')) {
            return $this->buildDevExceptionDecorator($exception);
        }

        return $this->buildExceptionDecorator($exception, 500);
    }

    /**
     * Retorna o decorator para acesso negado
     *
     * @param ForbiddenException $exception
     * @return callable
     */
    public function getForbiddenDecorator(ForbiddenException $exception)
    {
        return $this->buildExceptionDecorator($exception, 403);
    }

    /**
     * Retorna o decorator para acesso não autorizado
     *
     * @param UnauthorizedException $exception
     * @return callable
     */
    public function getUnauthorizedDecorator(UnauthorizedException $exception)
    {
        return $this->buildExceptionDecorator($exception, 401);
    }

    /**
     * Obtém o decorator para qualquer exceção
     *
     * @param Exception $exception
     * @return callable
     */
    public function getExceptionDecorator(Exception $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundException:
                return $this->getNotFoundDecorator($exception);

            case $exception instanceof MethodNotAllowedException:
                return $this->getMethodNotAllowedDecorator($exception);

            case $exception instanceof ForbiddenException:
                return $this->getForbiddenDecorator($exception);

            case $exception instanceof UnauthorizedException:
                return $this->getUnauthorizedDecorator($exception);

            default:
                return $this->getErrorDecorator($exception);
        }
    }

    /**
     * Constrói o decorator da exceção
     *
     * @param Exception $exception
     * @param $status
     * @return callable
     */
    private function buildExceptionDecorator(Exception $exception, $status)
    {
        return function (RequestInterface $request, ResponseInterface $response) use ($exception, $status) {

            $scheme = 'http';
            if (!empty($_SERVER['HTTPS'])) {
                $scheme = 'https';
            }

            $url = $scheme."://".getenv('SYSTEM_HOST')."/";
            $processaTemplate = new ProcessaTemplateTwig();
            $processaTemplate->setTemplatePrincipal("templates/erros/{$status}.html.twig");
            $response = $response->withStatus($status);
            $response->getBody()->write(
                $processaTemplate->obterResultado([
                    'exception' => $exception,
                    'response' => $response,
                    'request' => $request,
                    'DIR_URL' =>$url
                ])
            );
            return $response;
        };
    }

    /**
     * Retorna tratamento de erro específico do desenvolvimento
     *
     * @param Exception $exception
     * @return \Closure
     */
    private function buildDevExceptionDecorator(\Exception $exception)
    {
        return function (ServerRequestInterface $request, ResponseInterface $response) use ($exception) {
            return WhoopsRunner::handle($exception, $request);
        };
    }
}