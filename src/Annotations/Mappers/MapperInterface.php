<?php

namespace Onetoweb\GlsFreight\Annotations\Mappers;

/**
 * Mapper Interface.
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