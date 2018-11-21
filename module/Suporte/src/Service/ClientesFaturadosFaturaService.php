<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 10:56
 */

namespace Rtd\Suporte\Service;

use Helpers\Doctrine\EntityManagerHelper;
use Rtd\Suporte\Entity\Central\Status;
use Rtd\Suporte\Entity\Financeiro\Faturas;
use Rtd\Suporte\Repository\Interfaces\ClientesFaturadosRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\CustasServicosRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\FaturaRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PedidosItensRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PedidosRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaFisicaRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaJuridicaRepositoryInterface;
use Rtd\Suporte\Service\Interfaces\ClientesFaturadosFaturaServiceInterface;
use Sistema\Exception\SistemaException;

class ClientesFaturadosFaturaService implements ClientesFaturadosFaturaServiceInterface
{
    use EntityManagerHelper;

    private $pedidosRepository;
    private $pedidosItensRepository;
    private $custasServicosRepository;
    private $clientesFaturadosRepository;
    private $faturaRepository;
    private $faturas;
    private $status;
    private $pessoaJuridicaRepository;
    /**
     * @var PessoaFisicaRepositoryInterface
     */
    private $pessoaFisicaRepository;

    public function __construct(
        PedidosRepositoryInterface $pedidosRepository,
        PedidosItensRepositoryInterface $pedidosItensRepository,
        CustasServicosRepositoryInterface $custasServicosRepository,
        ClientesFaturadosRepositoryInterface $clientesFaturadosRepository,
        FaturaRepositoryInterface $faturaRepository,
        Faturas $faturas,
        Status $status,
        PessoaJuridicaRepositoryInterface $pessoaJuridicaRepository,
        PessoaFisicaRepositoryInterface $pessoaFisicaRepository)
    {
        $this->pedidosRepository            = $pedidosRepository;
        $this->pedidosItensRepository       = $pedidosItensRepository;
        $this->custasServicosRepository     = $custasServicosRepository;
        $this->clientesFaturadosRepository  = $clientesFaturadosRepository;
        $this->faturaRepository             = $faturaRepository;
        $this->faturas                      = $faturas;
        $this->status                       = $status;
        $this->pessoaJuridicaRepository     = $pessoaJuridicaRepository;
        $this->pessoaFisicaRepository       = $pessoaFisicaRepository;
    }
    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarClientesFaturados(string $ni)
    {
        return $this->clientesFaturadosRepository->buscarPedidosClientesFaturados($ni);
    }

    /**
     * @param string $ni
     * @param string $dataInicial
     * @param string $dataFinal
     * @return mixed
     */
    public function buscarTodosPedidosPorData(string $ni, string $dataInicial, string $dataFinal)
    {
        return $this->pedidosRepository->buscarPedidosPorDatas($ni, $dataInicial, $dataFinal);
    }

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarTodosPedidos(string $ni)
    {
        return $this->pedidosRepository->buscarPedidos($ni);
    }

    /**
     * @param string $idPedido
     * @return mixed
     */
    public function buscarItensPedidos(string $idPedido)
    {
        return $this->pedidosItensRepository->buscarPedidosItens($idPedido);
    }

    /**
     * @param string $ni
     * @return mixed
     */
    public function faturarCliente(string $ni)
    {
        return $this->clientesFaturadosRepository->buscarPedidosClientesFaturados($ni);
    }

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarClienteFaturadoPorNi(string $ni)
    {
        return $this->clientesFaturadosRepository->buscarClienteFaturadoPorNi($ni);
    }

    /**
     * @param array $request
     * @return mixed
     * @throws \Exception
     */
    public function salvarFatura(array $request)
    {
        try {
//            $this->faturaRepository->buscarUmaFaturaPorPeriodo($request['request']);
//            $fatura = $this->montarObjetoFatura($request);
            $this->gerarBoletoFatura($request['request']);
//            $response = $this->faturaRepository->salvarNovaFatura($fatura);
        } catch (SistemaException $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param array $request
     * @return mixed|null
     */
    public function gerarBoletoFatura(array $request)
    {
        $verificarPessoaJuridica = $this->pessoaJuridicaRepository->buscarUmaPessoaJuridica($request['ni']);

        if (count($verificarPessoaJuridica) > 0) {
            return $verificarPessoaJuridica;
        }

        $verificarPessoaFisica = $this->pessoaFisicaRepository->buscarUmPessoaFisica($request['ni']);

        if (count($verificarPessoaFisica) > 0) {
            return $verificarPessoaFisica;
        }

        return null;
    }

    /**
     * @param array $request
     * @return Faturas
     */
    public function montarObjetoFatura(array $request)
    {
        $valor = $this->getValorFinalFatura($request);

        $clientesFaturados = $this->clientesFaturadosRepository->buscarClienteFaturadoPorNi($request['request']['ni']);
        $status            = $this->getDoctrine()->getRepository(Status::class)->findOneBy([
            'id'          => 25,
            'tipoStatus'  => 2
        ]);

        return $this->faturas
                    ->setNi($clientesFaturados)
                    ->setDataInicio(new \DateTime($request['request']['start']))
                    ->setDataFim(new \DateTime($request['request']['end']))
                    ->setStatus($status)
                    ->setValor($valor);
    }

    /**
     * @param array $request
     * @return int
     */
    public function getValorFinalFatura(array $request)
    {
        $valor = 0;

        foreach ($request['pedidosItens'] as $pedidosItens) {
            $valor += $pedidosItens['valor'];
        }

        foreach ($request['custaPedido'] as $custaPedido) {
            $valor += $custaPedido['valor'];
        }

        foreach ($request['custaPedidoItens'] as $custaPedidoItens) {
            $valor += $custaPedidoItens['valor'];
        }

        return $valor;
    }
}