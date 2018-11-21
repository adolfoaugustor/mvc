<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 13:42
 */

namespace Sistema\PDF;

use mikehaertl\shellcommand\Command;
use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\FalhaNaExecucaoDoComandoException;
use Sistema\Filesystem\Filesystem;
use Sistema\Filesystem\FilesystemInterface;

/**
 * Representação dos metadados do PDF. Por padrão, a especificação do PDF define 8
 * Metadados padrão:
 *
 *  - Author: Nome do autor do PDF
 *  - CreationDate: Data de Criação do PDF
 *  - Creator: Criador (aplicação que gerou o PDF)
 *  - Producer: Produtor (normalmente o mesmo valor de Creator)
 *  - Subject: Assunto do documento
 *  - Title: título do documento
 *  - Keywords: palavras-chave (podem ser separadas por vírgula)
 *  - ModDate: Data de modificação
 *
 * @package Sistema\Core\PDF
 */
class PDFMetatag implements PDFMetatagInterface
{
    /**
     * @var array
     */
    protected $metadata;
    protected $arquivo_temporario;
    protected $arquivo_original;

    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    public function __construct($arquivo_original)
    {
        $this->arquivo_original = $arquivo_original;
        $this->arquivo_temporario = new ArquivoTemporario();
        $this->filesystem = new Filesystem();

        $this->metadata = $this->processarMetadados(
            $this->obterConteudoDosMetadados($arquivo_original)
        );
    }

    /**
     * Retorna os metadados
     *
     * @param $key
     * @return string Metadados
     */
    public function get($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    /**
     * Adiciona um metadado ao PDF
     *
     * @param $key
     * @param $value
     * @throws FalhaNaExecucaoDoComandoException
     */
    public function set($key, $value)
    {
        $this->metadata[$key] = $value;
        $this->atualizarMetadadosDoPdf();
    }

    /**
     * Verifica se um metadado existe
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->metadata);
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return $this->metadata;
    }

    /**
     * Atualiza os metadados do pdf
     * @throws FalhaNaExecucaoDoComandoException
     */
    private function atualizarMetadadosDoPdf()
    {
        $temp = new ArquivoTemporario;

        $this->filesystem->salvar(
            $temp->obterCaminhoArquivo(),
            $this->gerarMetadados()
        );

        $command = new Command(
            "pdftk {$this->arquivo_original} update_info {$temp} output {$this->arquivo_temporario}"
        );

        if (!$command->execute()) {
            throw new FalhaNaExecucaoDoComandoException(
                "Comando para atualização dos metadados falhou",
                $command->getExitCode(),
                null,
                ['message' => $command->getError()]
            );
        }

        $this->filesystem->copiar(
            $this->arquivo_temporario->obterCaminhoArquivo(),
            $this->arquivo_original
        );
    }

    /**
     * Gera string de metadados
     *
     * @return string
     */
    private function gerarMetadados()
    {
        $metadados = '';
        foreach ($this->metadata as $key => $value) {
            $metadados .= "InfoBegin\nInfoKey: {$key}\nInfoValue: {$value}\n";
        }

        return $metadados;
    }

    /**
     * Processa uma string de metadados e retorna um array associativo
     *
     * @param $conteudo
     * @return array
     */
    private function processarMetadados($conteudo)
    {
        $metadata = [];
        $pattern = '/InfoBegin\nInfoKey:\s*(.+?)$\nInfoValue:\s*(.+?)$/m';

        if (preg_match_all($pattern, $conteudo, $matches)) {
            $metadata = array_combine($matches[1], $matches[2]);
        }

        return $metadata;
    }

    /**
     * Escreve os metadados em um arquivo
     *
     * @param $arquivo_original
     * @param $arquivo_destino
     * @throws FalhaNaExecucaoDoComandoException
     */
    private function escreverMetadadosDoPdfNoArquivo($arquivo_original, $arquivo_destino)
    {
        $command = new Command(
            "pdftk {$arquivo_original} dump_data output {$arquivo_destino}"
        );

        if (!$command->execute()) {
            throw new FalhaNaExecucaoDoComandoException(
                "Comando {$command->getCommand()} para obter informaçõs do pdf falhou: {$command->getError()}",
                $command->getExitCode()
            );
        }
    }

    /**
     * Faz a leitura dos metadados do pdf
     *
     * @param $arquivo_original
     * @return bool|string
     * @throws FalhaNaExecucaoDoComandoException
     */
    private function obterConteudoDosMetadados($arquivo_original)
    {
        $arquivo_temporario = new ArquivoTemporario;
        $this->escreverMetadadosDoPdfNoArquivo($arquivo_original, $arquivo_temporario->obterCaminhoArquivo());
        return $this->filesystem->obterConteudo($arquivo_temporario->obterCaminhoArquivo());
    }
}