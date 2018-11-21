<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 15:33
 */

namespace Sistema\Translation;


use Gettext\Translations;
use Gettext\Extractors;
use Sistema\Filesystem\ArquivoInterface;

class TranslationExtractor
{
    /**
     * Extrai traduções de diferentes tipos de arquivos
     *
     * @param iterable|ArquivoInterface[]|ArquivoInterface $source
     * @return Translations
     */
    public function extract($source): Translations
    {
        if (is_iterable($source)) {
            return $this->extractFromIterableSource($source);
        }

        if (! $source instanceof ArquivoInterface) {
            throw new \InvalidArgumentException(
                '$source deve ser instância de ' . ArquivoInterface::class . ' ou iterable'
            );
        }

        $translations = new Translations();
        $extractor = $this->getExtractor($source);
        call_user_func([$extractor, 'fromFile'], $source->obterCaminhoArquivo(), $translations);
        return $translations;
    }

    /**
     * Extrai translations a partir de um iterable
     *
     * @param iterable $source
     * @return Translations
     */
    private function extractFromIterableSource(iterable $source): Translations
    {
        $translations = new Translations();
        foreach ($source as $arquivo) {
            $translations->mergeWith(
                $this->extract($arquivo)
            );
        }
        return $translations;
    }

    /**
     * Obtém o nome da classe extractor
     *
     * @param ArquivoInterface $source
     * @return string
     */
    private function getExtractor(ArquivoInterface $source)
    {
        switch ($source->obterTipoArquivo()) {
            case '.twig':
                return TwigExtractor::class;
            case '.php':
                return Extractors\PhpCode::class;
            case '.po':
                return Extractors\Po::class;
            default:
                throw new \DomainException(
                    'Extractor para arquivo do tipo ' . $source->obterTipoArquivo() . ' não reconhecido'
                );
        }
    }
}