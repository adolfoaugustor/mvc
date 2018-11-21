<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 21/08/18
 * Time: 11:10
 */

namespace Sistema\Mail;


class DadosEmailTemplate implements DadosEmailInterface
{
    private $dados = [];

    /**
     * DadosEmailTemplate constructor.
     * @param array $dados
     */
    public function __construct(string $pessoa, string $titulo)
    {
        $this->dados['pessoa'] = $pessoa;
        $this->dados['titulo'] = $titulo;
    }

    public function dadosAdicionaisSimples(string $chave, string $valor)
    {
        $this->dados[$chave] = $valor;
        return $this;
    }

    public function adicionarArray(string $chave, array $valores)
    {
        foreach ($valores as $valor) {
            $this->dados[$chave][] = $valor;
        }
        return $this;
    }

    public function obterDados(): array
    {
        return $this->dados;
    }

}