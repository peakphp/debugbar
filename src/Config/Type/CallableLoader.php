<?php

namespace Peak\Config\Type;

use Peak\Config\Loader;
use \Exception;

class CallableLoader extends Loader
{
    /**
     * Constructor
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->content = $config();

        if (!is_array($this->content)) {
            throw new Exception(__CLASS__.': Closure/Callable config must return an array');
        }
    }
}
