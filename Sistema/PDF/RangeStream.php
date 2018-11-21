<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 16/01/18
 * Time: 15:05
 */

namespace Sistema\PDF;

use Sistema\Exception\ArquivoNaoEncontradoException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Implementa o Streaming de dados do PDF sob demanda
 *
 * @package Sistema\Core\PDF
 */
class RangeStream
{
    /**
     * @var \SplFileObject
     */
    protected $file;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request, $filename)
    {
        if (!file_exists($filename)) {
            throw new ArquivoNaoEncontradoException("Arquivo não encontrado {$filename}");
        }

        $this->file = new \SplFileObject($filename, 'rb');
        $this->request = $request;
    }

    public function stream()
    {
        if ($this->request->headers->has('Range')) {
            $response = $this->handleRangeRequest();
            $response->send();
            return;
        }

        $response = $this->handleFullStreamRequest();
        $response->send();
    }

    /**
     * Processa uma requisição de alcance
     *
     * @return Response
     */
    private function handleRangeRequest()
    {
        $size = $this->file->getSize();
        $start = 0;
        $end = $size - 1;

        $range = $this->request->headers->get('Range');
        $matches = [];

        if (!preg_match('/^bytes=(\d+?)-(\d+?)$/', $range, $matches)) {
            $response = new Response('', Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, [
                'Content-Range' => "bytes $start-$end/$size"
            ]);

            return $response;
        }

        $c_start = $matches[1];
        $c_end = $matches[2] > $end ? $end : $matches[2];

        if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
            $response = new Response('', Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, [
                'Content-Range' => "bytes $start-$end/$size"
            ]);

            return $response;
        }

        $start  = $c_start;
        $end    = $c_end;
        $length = $end - $start + 1;

        $response = new StreamedResponse(function () use ($start, $end) {
            $this->sendStream($start, $end);
        }, Response::HTTP_PARTIAL_CONTENT);

        $response->headers = $this->makeHeaders();
        $response->headers->set('Content-Range', "bytes $start-$end/{$size}");
        $response->headers->set('Content-Length', $length);

        $response->setStatusCode(Response::HTTP_PARTIAL_CONTENT);

        return $response;
    }

    /**
     * Processa a requisição full stream
     *
     * @return Response
     */
    private function handleFullStreamRequest()
    {
        $size = $this->file->getSize();
        $start = 0;
        $end = 0.005 * $size;
        $end = $end < 1024 * 1024 ? 1024 * 1024 : $end;

        $response = new StreamedResponse(function () use ($start, $end) {
            $this->sendStream($start, $end);
        });

        $response->headers = $this->makeHeaders();
        $response->headers->set('Content-Range', "bytes $start-$end/{$size}");
        $response->headers->set('Content-Length', $size);

        return $response;
    }

    /**
     * Monta os headers básicos para stream
     *
     * @return ResponseHeaderBag
     */
    private function makeHeaders()
    {
        $headers = new ResponseHeaderBag();
        $headers->set('Content-type', 'application/pdf');

        $disposition = $headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            basename($this->file->getBasename())
        );

        $headers->set('Content-Disposition', $disposition);
        $headers->set('Accept-Ranges', 'bytes');

        return $headers;
    }

    /**
     * Envia um stream de dados do PDF
     *
     * @param $start
     * @param $end
     */
    private function sendStream($start = 0, $end = PHP_INT_MAX)
    {
        $size = $this->file->getSize();
        $start = $start < 0 ? 0 : $start;
        $end = $end > $size ? $size : $end;

        $this->file->fseek($start);
        $buffer = 1024 * 8;

        while(!$this->file->eof() && ($p = $this->file->ftell()) <= $end) {
            if ($p + $buffer > $end) {
                $buffer = $end - $p + 1;
            }
            set_time_limit(0);
            echo $this->file->fread($buffer);
            flush();
        }
    }
}