<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 26/10/18
 * Time: 11:02
 */

namespace Rtd\Suporte\Controller;

use Helpers\GeneratePdf\GeneratePdfHelper;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Service\Interfaces\ClientesFaturadosFaturaServiceInterface;
use Rtd\Suporte\Service\Interfaces\CustosAdicionaisServiceInterface;
use Sistema\AbstractController\Controller;

class ClientesFaturadosFaturaController extends Controller
{
    private $generatePdfHelper;
    private $clientesFaturadosFaturaService;
    private $custosAdicionaisService;

    public function __construct(
        GeneratePdfHelper $generatePdfHelper,
        ClientesFaturadosFaturaServiceInterface $clientesFaturadosFaturaService,
        CustosAdicionaisServiceInterface $custosAdicionaisService)
    {
        $this->generatePdfHelper              = $generatePdfHelper;
        $this->clientesFaturadosFaturaService = $clientesFaturadosFaturaService;
        $this->custosAdicionaisService        = $custosAdicionaisService;
    }

    public function listarDetalhesFaturados(ServerRequestInterface $request, $ni)
    {
        $request = $request->getParsedBody();

        if (count($request) > 0) {
            $pedidos = $this->clientesFaturadosFaturaService->buscarTodosPedidosPorData($ni, $request['start'], $request['end']);
        }
        $clienteFaturados = $this->clientesFaturadosFaturaService->buscarClientesFaturados($ni);
        if (is_null($clienteFaturados)) {
            return $this->view('suporte/clientes-faturados-fatura.twig',[], [
                'errors' => 'O cliente não possui pedidos registrados para gerar a fatura.'
            ]);
        }

        return $this->view('suporte/clientes-faturados-fatura.twig',[], [
            'pedidos'   => $pedidos ?? null,
            'ni'        => $ni,
            'cliente'   => $clienteFaturados[0],
        ]);
    }

    public function buscarPedidosPorData(ServerRequestInterface $request)
    {
        $request = $request->getParsedBody();

        $pedidos = $this->clientesFaturadosFaturaService->buscarTodosPedidosPorData(
            $request['ni'] ?? '',$request['start'] ?? '', $request['end'] ?? ''
        );

        return HttpResponseJson::json('Pedidos encontrados', $pedidos);
    }

    public function buscarPedidosItens(ServerRequestInterface $request)
    {
        $request = $request->getParsedBody();

        $response = $this->clientesFaturadosFaturaService->buscarItensPedidos($request['id'] ?? '');

        return HttpResponseJson::json('Itens Pedidos encontrados', $response);
    }

    public function buscarCustosAdicionaisPedidosItens(ServerRequestInterface $request)
    {
        $request = $request->getParsedBody();

        $response = $this->custosAdicionaisService->buscarCustoAdicionalPedidosItens($request['id'] ?? '', $request['pedido_id']);

        return HttpResponseJson::json('Custos adicionais itens pedidos encontrados', $response);
    }

    /**
     * @param ServerRequestInterface $request
     * @param $response
     * @return mixed
     * @throws \Exception
     */
    public function gerarFatura(ServerRequestInterface $request, $response)
    {
        $request = $request->getParsedBody();

        $pedidos = $this->clientesFaturadosFaturaService->buscarTodosPedidosPorData(
            $request['dates']['ni'] ?? '',
            $request['dates']['start'] ?? '',
            $request['dates']['end'] ?? ''
        );

        $clienteFaturado = $this->clientesFaturadosFaturaService->buscarClienteFaturadoPorNi($request['dates']['ni']);

        $pedidosItens    = null;
        $custaPedido     = null;
        $custaPedidoItem = null;

        foreach ($pedidos as $pedido) {
            $pedidosItens  = $this->clientesFaturadosFaturaService->buscarItensPedidos($pedido['id']);
            $custaPedido   = $this->custosAdicionaisService->buscarCustoAdicionalPedidos($pedido['id']);
        }
        foreach ($pedidosItens as $pedidosIten) {
            $custaPedidoItem = $this->custosAdicionaisService->buscarCustoAdicionalPedidosItens($pedido['id'], $pedidosIten['id']);
        }

        $content = null;

        try {
            $this->clientesFaturadosFaturaService->salvarFatura([
                'request'           => $request['dates'],
                'clienteFaturado'   => $clienteFaturado,
                'pedidosItens'      => $pedidosItens,
                'custaPedidoItens'  => $custaPedidoItem,
                'custaPedido'       => $custaPedido,
            ]);

            $content = $this->generatePdfHelper
                            ->loadTemplate('suporte/fatura/modelo-fatura.twig')
                            ->getContentToHtml([
                                'clienteFaturado'   => $clienteFaturado,
                                'pedidosItens'      => $pedidosItens,
                                'custaPedidoItens'  => $custaPedidoItem,
                                'custaPedido'       => $custaPedido,
                            ]);
        } catch (\Exception $exception) {
            return HttpResponseJson::json('Não foi possível gerar a fatura.',[],
                401,[$exception->getMessage()]
            );
        }

        $renderPdf = $this->generatePdfHelper->renderPdfForBrowser($content);
        header('Content-Type:application/pdf');
        $response->getBody()->write($renderPdf);
        return $response;
    }
}