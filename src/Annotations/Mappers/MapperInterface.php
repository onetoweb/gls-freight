<?php

namespace Onetoweb\GlsFreight\Annotations\Mappers;

/**
 * Mapper interface.
 */
interface MapperInterface
{
    /**
     * @param object $object
     * 
     * @return array with mapped data
     */
    public function map(object $object): array;
}