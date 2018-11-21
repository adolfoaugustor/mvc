<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 18:22
 */

namespace Sistema\PDF;
use mikehaertl\shellcommand\Command;

/**
 * Classe de Manipulação para substituição de textos
 *
 * Note que caso o PDF tenha sido scaneado, ou caso as páginas estejam renderizadas como
 * imagens, não será possível realizar a substituição do texto.
 *
 * Observação: PDFs gerados com o backend Wk não possibilitam a substituição de texto, portanto
 * recomenda-se que na geração do PDF seja utilizado o GeradorDomPdf.
 *
 * @package Sistema\Core\PDF
 */
class SubstituiTexto implements SubstituiTextoPDFInterface
{
    protected $nome_arquivo;
    protected $arquivo_temporario_entrada;
    protected $arquivo_temporario_saida;
    protected $shell;

    public function __construct($nome_arquivo)
    {
        $this->nome_arquivo = $nome_arquivo;
        $this->arquivo_temporario_entrada = tempnam(sys_get_temp_dir(), 'pdf_');
        $this->arquivo_temporario_saida = tempnam(sys_get_temp_dir(), 'pdf_');

        if ($this->arquivo_temporario_entrada === false || $this->arquivo_temporario_saida === false) {
            $this->cleanUp();
            throw new \Exception("Não foi possível criar os arquivos temporários");
        }

        if (!file_exists($nome_arquivo)) {
            $this->cleanUp();
            throw new \Exception("Arquivo de origem não encontrado");
        }
    }

    public function __destruct()
    {
        $this->cleanUp();
    }

    public function substituir($pesquisa, $substituicao)
    {
        $pesquisa = preg_quote($pesquisa, '/');
        $substituicao = preg_quote($substituicao, '/');

        $commands = array();

        $commands[] = new Command(
            "pdftk {$this->nome_arquivo} output {$this->arquivo_temporario_entrada} uncompress"
        );

        $commands[] = new Command(
            "sed -i 's/{$pesquisa}/{$substituicao}/' {$this->arquivo_temporario_entrada}"
        );

        $commands[] = new Command(
            "pdftk {$this->arquivo_temporario_entrada} output {$this->arquivo_temporario_saida} compress"
        );

        foreach ($commands as $command) {
            if (!$command->execute()) {
                throw new \Exception($command->getError(), $command->getExitCode());
            }
        }

        return $this;
    }

    public function salvar()
    {
        if (!copy($this->arquivo_temporario_saida, $this->nome_arquivo)) {
            throw new \Exception("Não foi possível salvar o arquivo");
        }
    }

    public function salvarComo($nome_arquivo)
    {
        if (!copy($this->arquivo_temporario_saida, $nome_arquivo)) {
            throw new \Exception("Não foi possível salvar o arquivo");
        }

        return $this;
    }

    public function obterResultado()
    {
        $conteudo = file_get_contents($this->arquivo_temporario_saida);

        if ($conteudo === false) {
            throw new \Exception("Não foi possível ler o arquivo temporário");
        }

        return $conteudo;
    }

    private function cleanUp()
    {
        unlink($this->arquivo_temporario_saida);
        unlink($this->arquivo_temporario_entrada);
    }
}