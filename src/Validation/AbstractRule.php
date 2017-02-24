<?php

namespace Peak\Validation;

use Peak\Validation\RuleInterface;

abstract class AbstractRule implements RuleInterface
{
    /**
     * Default options
     * @var array
     */
    protected $default_options = [];

    /**
     * Options
     * @var array
     */
    protected $options = [];

    /**
     * Flags for php validate filters
     * @var integer
     */
    protected $flags = null;

    /**
     * Construct
     * 
     * @param array  $options 
     */
    public function __construct($options = [], $flags = null)
    {
        $this->options = array_merge($this->default_options, $options);
        $this->flags = $flags;
        $this->removeNullOptions();
        $this->init();
    }

    /**
     * Init after merging options
     */
    public function init()
    {
    }

    /**
     * Remove null options
     */
    protected function removeNullOptions()
    {
        foreach($this->options as $key => $value) {
            if($value === null) {
                unset($this->options[$key]);
            }
        }
    }

    /**
     * Get options array for filter_var()
     * 
     * @return array
     */
    protected function getFilterVarOptions()
    {
        return [
            'options' => $this->options,
            'flags'   => $this->flags,
        ];
    }
}
