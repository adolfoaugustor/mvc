<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 14:54
 */

namespace Sistema\Mail;

/**
 * Abstrai os dados do corpo de um email.
 *
 * Todos os emails customizados do sistema devem estender dessa classe
 * de modo a poder utilizar o Facade Email
 *
 * @package Sistema\Core\Mail
 */
abstract class MailMessage
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $dados = [];

    /**
     * @var array
     */
    private $anexos = [];

    /**
     * @var string
     */
    private $remetente;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $assunto;

    /**
     * @var array $imagens
     */
    private $imagens = [];

    /**
     * Método a ser implementado.
     * O intuito é configurar as características do email
     * Tal como template, dados, anexos e remetente
     */
    public abstract function configurar();

    /**
     * Define o template do Email
     *
     * @param string $template
     * @return self
     */
    protected function template($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Obtém o template definido
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Define os dados a serem passados para o template
     *
     * @param array $dados
     * @return self
     */
    protected function dados(array $dados)
    {
        $this->dados = $dados;
        return $this;
    }

    /**
     * Obtém os dados do template
     *
     * @return array
     */
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Anexa um arquivo no email
     *
     * @param $arquivo
     * @return self
     */
    protected function anexar($arquivo)
    {
        if (is_array($arquivo)) {
            foreach ($arquivo as $anexo) {
                $this->anexos[] = $anexo;
            }
            return $this;
        }

        $this->anexos[] = $arquivo;
        return $this;
    }

    /**
     * Obtém os Anexos
     *
     * @return array
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Define o remetente do email
     *
     * @param string $remetente
     * @return self
     */
    protected function de($remetente, $alias = '')
    {
        $this->remetente = $remetente;
        $this->alias = $alias;
        return $this;
    }

    /**
     * Obtém o remetente do email
     *
     * @return string
     */
    public function getRemetente()
    {
        return $this->remetente;
    }

    /**
     * Obtém o alias do remetente
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Define o assunto do email
     *
     * @param string $assunto
     * @return self
     */
    protected function assunto($assunto)
    {
        $this->assunto = $assunto;
        return $this;
    }

    /**
     * Obtem o assunto do email
     *
     * @return string
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * Embute uma imagem com padrão CID
     *
     * @param $caminho
     * @param $cid
     * @param string $alias
     * @return MailMessage
     */
    protected function embutirImagem($caminho, $cid, $alias = '')
    {
        $this->imagens[] = [$caminho, $cid, $alias];
        return $this;
    }

    /**
     * Obtém as imagens embutidas
     *
     * @return array
     */
    public function getImagens()
    {
        return $this->imagens;
    }
}