<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/07/18
 * Time: 16:53
 */

namespace Sistema\Mail;


use Sistema\Mail\MailTransporterInterface;
use Sistema\Worker\EnviarEmailWorker;

class QueueMailTransporter implements MailTransporterInterface
{
    /**
     * @var array $dados
     */
    private $dados = [];

    /**
     * @inheritDoc
     */
    public function setPara($destinatario)
    {
        $this->dados['para'] = $destinatario;
    }

    /**
     * @inheritDoc
     */
    public function setCopia($copia)
    {
        $this->dados['copia'] = $copia;
    }

    /**
     * @inheritDoc
     */
    public function setCopiaOculta($copia_oculta)
    {
        $this->dados['copia_oculta'] = $copia_oculta;
    }

    /**
     * @inheritDoc
     */
    public function setDe($remetente, $alias = '')
    {
        $this->dados['remetente'] = [$remetente, $alias];
    }

    /**
     * @inheritDoc
     */
    public function enviar($assunto, $conteudo = '', $anexo = [], $imagem = [])
    {
        $this->dados['assunto'] = $assunto;
        $this->dados['conteudo'] = $conteudo;
        $this->dados['anexo'] = $anexo;
        $this->dados['imagem'] = $imagem;

        EnviarEmailWorker::dispatch($this->dados);
    }
}