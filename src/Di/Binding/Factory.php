<?php

namespace Peak\Di\Binding;

use Peak\Di\AbstractBinding;
use Psr\Container\ContainerInterface;

class Factory extends AbstractBinding
{
    /**
     * Constructor
     *
     * @param string $name
     * @param callable $definition
     */
    public function __construct($name, $definition)
    {
        parent::__construct($name, self::FACTORY, $definition);
    }

    /**
     * Resolve the binding
     *
     * @param ContainerInterface $container
     * @param array $args
     * @param callable|null $explicit
     * @return mixed|null
     * @throws \Exception
     */
    public function resolve(ContainerInterface $container, $args = [], $explicit = null)
    {
        $definition = $this->definition;

        if (!is_null($explicit) && !empty($explicit)) {
            $definition = $explicit;
        }

        if (!is_callable($definition)) {
            throw new \Exception(__CLASS__.': Definition for '.$this->name.' is not a Closure');
        }

        return $definition($container, $args);
    }
}