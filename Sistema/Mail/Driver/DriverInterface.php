<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/12/17
 * Time: 09:27
 */

namespace Sistema\Mail\Driver;

/**
 * Abstração do driver de conexão ao Email
 * @package Sistema\Core\Mail\Driver
 */
interface DriverInterface
{
    /**
     * Adiciona um anexo a partir de um arquivo no sistema
     *
     * @param string $arquivo Caminho completo para o arquivo
     * @param string $nome Nome para ser substituído no anexo
     * @param string $mime Mime/Type
     */
    public function adicionarAnexo($arquivo, $nome = '', $mime = '');

    /**
     * Aciciona um anexo a partir de uma String
     *
     * @param string $conteudo Conteúdo binário a ser anexado
     * @param string $nome Nome do anexo
     * @param string $mime Mime/Type
     */
    public function adicionarConteudoAnexo($conteudo, $nome, $mime = '');

    /**
     * Adiciona um destinatário ao email
     *
     * @param string $endereco
     * @param string $nome
     */
    public function adicionarDestinatario($endereco, $nome = '');

    /**
     * Adiciona um endereço de cópia ao email
     *
     * @param string $endereco
     * @param string $nome
     */
    public function adicionarCopia($endereco, $nome = '');

    /**
     * Adiciona um endereço de cópia oculta
     *
     * @param string $endereco
     * @param string $nome
     */
    public function adicionarCopiaOculta($endereco, $nome = '');

    /**
     * Adiciona o rementente do email
     *
     * @param string $endereco
     * @param string $nome
     */
    public function adicionarRemetente($endereco, $nome = '');

    /**
     * Envia o email
     *
     * @param string $assunto
     * @param string $conteudo
     */
    public function enviar($assunto, $conteudo);

    /**
     * Adiciona uma imagem embutida
     *
     * @param $arquivo
     * @param $cid
     * @param string $alias
     */
    public function adicionarImagem($arquivo, $cid, $alias = '');
}