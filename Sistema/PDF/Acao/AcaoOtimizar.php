<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/01/18
 * Time: 12:52
 */

namespace Sistema\PDF\Acao;

use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Linearizador;
use Sistema\PDF\Merger;
use Sistema\PDF\OtimizacaoResolucao;
use Sistema\Twig\Template\ProcessaTemplateTwig;

class AcaoOtimizar implements AcaoExecutavelInterface
{
    /**
     * @var OtimizacaoResolucao
     */
    protected $otimizador;

    /**
     * @var Linearizador
     */
    protected $linearizador;

    /**
     * Otimiza a resolução do PDF, habilitando-o a ser utilizado em pré-visualização, por exemplo.
     * Recebe como parâmetro uma string informando o nível de otimização. Verifica as constantes
     * da classe OtimizacaoResolucao para verificar os níveis existentes.
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        $this->otimizador = new OtimizacaoResolucao($arquivo_temporario);
        $this->linearizador = new Linearizador($arquivo_temporario);
        $this->otimizar(...$arguments);
    }

    /**
     * Executa a ação de otimização
     *
     * @param $nivel
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function otimizar($nivel = OtimizacaoResolucao::NIVEL_SCREEN)
    {
        // Otimizar a resolucao
        $this->otimizador->otimizar($nivel);
        $this->otimizador->salvar();

        // Linearizar
        $this->linearizador->linearizar();
        $this->linearizador->salvar();
    }
}