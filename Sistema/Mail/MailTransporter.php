<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 15:00
 */

namespace Sistema\Mail;

use Sistema\Mail\Driver\DriverInterface;

/**
 * Implementação do transporte de emails com PHPMailer
 *
 * @package Sistema\Core\Mail
 */
class MailTransporter implements MailTransporterInterface
{
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @inheritdoc
     */
    public function setPara($destinatario)
    {
        if (!is_array($destinatario)) {
            $destinatario = [$destinatario];
        }

        foreach ($destinatario as $endereco => $nome) {
            if (is_int($endereco)) {
                $this->driver->adicionarDestinatario($nome);
            } else {
                $this->driver->adicionarDestinatario($endereco, $nome);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setCopia($copia)
    {
        if (!is_array($copia)) {
            $copia = [$copia];
        }

        foreach ($copia as $endereco => $nome) {
            if (is_int($endereco)) {
                $this->driver->adicionarCopia($nome);
            } else {
                $this->driver->adicionarCopia($endereco, $nome);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setCopiaOculta($copia_oculta)
    {
        if (!is_array($copia_oculta)) {
            $copia_oculta = [$copia_oculta];
        }

        foreach ($copia_oculta as $endereco => $nome) {
            if (is_int($endereco)) {
                $this->driver->adicionarCopiaOculta($nome);
            } else {
                $this->driver->adicionarCopiaOculta($endereco, $nome);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setDe($remetente, $alias = '')
    {
        $this->driver->adicionarRemetente($remetente, $alias);
    }

    /**
     * @inheritdoc
     */
    public function enviar($assunto, $conteudo = '', $anexos = [], $imagens = [])
    {
        foreach ($anexos as $anexo) {
            $this->driver->adicionarAnexo($anexo);
        }

        foreach ($imagens as $imagem) {
            $this->driver->adicionarImagem(...$imagem);
        }

        $this->driver->enviar($assunto, $conteudo);
    }
}