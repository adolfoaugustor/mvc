<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/07/18
 * Time: 16:56
 */

namespace Sistema\Worker;


use Sistema\Beanstalk\Worker;
use Sistema\Mail\MailTransporterInterface;

class EnviarEmailWorker extends Worker
{
    protected $tube = 'email';

    /**
     * @var MailTransporterInterface
     */
    private $transporter;

    public function __construct(MailTransporterInterface $transporter)
    {
        $this->transporter = $transporter;
    }

    /**
     * @inheritDoc
     */
    public function executar(array $dados)
    {
        echo "Enviando com assunto {$dados['assunto']}...\n";
        echo "Enviado para: " . print_r($dados['para']) . "\n";
        $this->transporter->setPara($dados['para']);

        if (isset($dados['copia'])) {
            $this->transporter->setCopia($dados['copia']);
        }

        if (isset($dados['copia_oculta'])) {
            $this->transporter->setCopiaOculta($dados['copia_oculta']);
        }

        $this->transporter->setDe($dados['remetente'][0], $dados['remetente'][1]);
        $this->transporter->enviar($dados['assunto'], $dados['conteudo'], $dados['anexo'], $dados['imagem']);
    }
}