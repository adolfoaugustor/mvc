<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/12/17
 * Time: 17:32
 */

namespace Sistema\ClassFinder;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

class ClassFinder
{
    protected $namespace;
    protected $src;
    protected $finder;

    /**
     * ClassFinder constructor.
     *
     * @param $namespace
     * @param $src
     */
    public function __construct($namespace, $src)
    {
        $this->namespace = $namespace;
        $this->src = $src;

        $this->finder = new Finder();
        $this->finder
            ->in($this->src)
            ->files()
            ->name('*.php')
        ;
    }

    /**
     * Busca todas as Classes recursivamente a partir do
     * src e Namespace informados no construtor.
     *
     * @return Collection Coleção de \ReflectionClass
     */
    public function find()
    {
        $classes = [];
        foreach ($this->finder as $file) {
            $path = $file->getRelativePathname();
            $class = $this->namespace . str_replace('/', '\\', $path);
            $class = str_replace('.php', '', $class);

            if (class_exists($class)) {
                $reflection = new \ReflectionClass($class);
                $classes[] = $reflection;
            }
        }

        return collect($classes);
    }
}