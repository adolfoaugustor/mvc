<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 14:50
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;
use Rtd\Suporte\Repository\Interfaces\TaxasConvenienciaRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarTaxasConvenienciaInterface;
use Rtd\Suporte\Service\Form\TaxaConvenienciaType;
use Rtd\Suporte\Service\Interfaces\Services\TaxasConvenienciaServiceInterface;
use Sistema\Exception\SistemaException;
use Symfony\Component\Form\FormInterface;

class TaxasConvenienciaService implements TaxasConvenienciaServiceInterface {


    private $formulario;
    private $taxasRepository;
    private $listarTaxas;

    public function __construct(FormularioInterface $formulario, TaxasConvenienciaRepositoryInterface $taxasConvenienciaRepository,ListarTaxasConvenienciaInterface $listarTaxasConveniencia)
    {

        $this->formulario = $formulario;
        $this->taxasRepository = $taxasConvenienciaRepository;
        $this->listarTaxas = $listarTaxasConveniencia;

    }

    public function listar()
    {
      return $this->listarTaxas->gerar();
    }

    public function obterTaxa($id)
    {
      return $this->taxasRepository->editar($id);
    }

    public function deletar($id)
    {
     $this->taxasRepository->deletar($id);
    }

    public function salvar($dados = [])
    {
      return $this->taxasRepository->salvar($dados);
    }

    public function obterFormulario($dados = null){

        if(!is_null($dados) && !($dados instanceof  TaxasConveniencia)){
            throw  new SistemaException("Os dados não são uma instancia de TaxasConveniencia");
        }

        return $this->formulario->obterFormulario('/suporte/taxa-conveniencia/salvar','POST',TaxaConvenienciaType::class,$dados)
            ->getForm()
            ->createView();
    }

}