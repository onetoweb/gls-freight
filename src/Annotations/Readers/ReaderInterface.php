<?php

namespace Onetoweb\GlsFreight\Annotations\Readers;

/**
 * Reader Interface.
 */
interface ReaderInterface
{
    /**
     * @param array $input,
     * @param string $class
     * 
     * @return object instanceof class
     */
    public function read(array $input, string $class): object;
}