<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 17/01/18
 * Time: 14:56
 */

namespace Sistema\Worker;


use Psr\Log\LoggerInterface;

use Sistema\Beanstalk\Worker;
use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Filesystem\FilesystemInterface;
use Sistema\PDF\PDF;

class GeraPreviewPDFWorker extends Worker
{
    protected $tube = 'preview_pdf';

    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function validar(array $dados)
    {
    }

    /**
     * @param array $dados
     */
    public function executar(array $dados)
    {
        if (!isset($dados['caminho'])) {
            throw new \Exception('Falta argumentos para o Worker');
        }

        if (!$this->filesystem->existe($dados['caminho'])) {
            throw new ArquivoNaoEncontradoException(
                "O arquivo para geração do preview não foi encontrado",
                null,
                $dados['caminho']
            );
        }

        $arquivo = new \SplFileInfo($dados['caminho']);
        $preview = $arquivo->getPath() . '/preview_' . $arquivo->getBasename();

        $pdf = new PDF($arquivo);
        $pdf
            ->otimizar()
            ->salvarComo($preview)
        ;
    }
}