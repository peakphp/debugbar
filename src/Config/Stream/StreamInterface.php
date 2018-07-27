<?php

declare(strict_types=1);

namespace Peak\Config\Stream;

/**
 * Interface StreamInterface
 * @package Peak\Config\Stream
 */
interface StreamInterface
{
    /**
     * @return mixed
     */
    public function get();
}