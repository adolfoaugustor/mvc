<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/11/17
 * Time: 09:33
 */

namespace Sistema\AbstractController;

use function DI\get;
use Helpers\Breadcrumbs\GuiaDeNavegacaoInterface;
use Sistema\Container\Container;
use Sistema\Routes\MatchInterface;
use Sistema\Twig\Template\ProcessaTemplateInterface;
use Symfony\Component\Routing\RouterInterface;
use Zend\Diactoros\Response;
use DI\Annotation\Inject;

/**
 * ControllerTest base do RTD
 *
 * Observação: Caso no método seja passado um objeto com o nome $request, essse será
 * substituído pelo objeto ServerRequestInterface decorado com a rota e a sessão.
 *
 * Caso seja passado um parametro $response, esse será substituido pelo mesmo objeto
 * processado pelas middlewares.
 */
abstract class Controller
{


    /**
     * @Inject()
     * @var GuiaDeNavegacaoInterface $guia;
     */
    protected $guia;

    /**
     * @Inject
     * @var ProcessaTemplateInterface
     */
    private $processador;
    /**
     * @param $template
     * @param array $views
     * @param array $dados
     * @return Response
     */


    protected function view($template, $views = array(), $dados = array())
    {

        //$rotas = Container::get(MatchInterface::class);

        //var_dump($rotas);


        $dados['breadcrumbs'] = $this->guia->renderizar();
        $this->processador->setTemplatePrincipal($template);
        $this->processador->setViews($views);
        $response = new Response();
        $response->getBody()->write(
            $this->processador->obterResultado($dados)
        );

        return $response;
    }
}