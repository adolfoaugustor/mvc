<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:36
 */

namespace Rtd\Suporte\Service;

use Exception;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Repository\Interfaces\FormaContatoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarFormasContatoInterface;
use Rtd\Suporte\Service\Form\UpdateFormaContatoType;
use Rtd\Suporte\Service\Interfaces\Services\FormaContatoServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class FormaContatoService implements FormaContatoServiceInterface
{


    private $formaContatoRepository;
    private $listarFormaContato;
    private $formulario;
    private $pessoaRepository;

    public function __construct(FormaContatoRepositoryInterface $formaContatoRepository, ListarFormasContatoInterface $listarFormaContato,FormularioInterface $formulario,
    PessoaRepositoryInterface $pessoaRepository)
    {
        $this->formaContatoRepository = $formaContatoRepository;
        $this->listarFormaContato = $listarFormaContato;
        $this->formulario = $formulario;
        $this->pessoaRepository = $pessoaRepository;

    }

    public function editar($id)
    {

        try {

            $form = $this->formaContatoRepository->editar($id);
            return $form;
        }catch (SistemaException $e){
            throw  new SistemaException($e->getMessage(),$e->getCode());
        }

    }

    public function obterFormularioIndex($ni){

        try {

        $pessoa = $this->pessoaRepository->editar($ni);

        $form  = new FormaContato();
        $form->setNi($pessoa);

        return $this->obterFormulario(UpdateFormaContatoType::class,$form);

        }catch (SistemaException $e){

            throw new SistemaException($e->getMessage(),$e->getCode());
        }


    }

    public function obterFormularioUpdate($id)
    {
        try {
            $formaContato = $this->formaContatoRepository->editar($id);
            return $this->obterFormulario(UpdateFormaContatoType::class, $formaContato);
        }catch (SistemaException $e){
            throw  new SistemaException($e->getMessage(),$e->getCode());
        }

    }


    /**
     * @param array $dados
     */
    public function salvar($dados = [])
    {
        return $this->formaContatoRepository->salvar($dados);
    }

    /**
     * @param $id
     */
    public function deletar($id)
    {
        $this->formaContatoRepository->deletar($id);
    }

    /**
     * @param $ni
     * @return mixed
     */
    public function listar($ni)
    {
        $this->listarFormaContato->setDados([
            'ni'=>$ni
        ]);

        return $this->listarFormaContato->gerar();
    }


    public function obterFormulario($type,$dados = null){

        return $this->formulario->obterFormulario('/suporte/pessoa/forma-contato/salvar','post',$type,$dados)->getForm()->createView();
    }

}