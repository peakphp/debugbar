<?php

namespace Peak\Config\Processors;

use Peak\Config\AbstractProcessor;
use Peak\Config\Exceptions\ProcessorException;

class JsonProcessor extends AbstractProcessor
{

    /**
     * @param $data
     * @throws ProcessorException
     */
    public function process($data)
    {
        // remove comments // and /* */
        $data = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t](//).*)#", '', $data);

        // decode json
        $this->content = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ProcessorException(__CLASS__.': error while decoding json > '.json_last_error_msg());
        }
    }
}
