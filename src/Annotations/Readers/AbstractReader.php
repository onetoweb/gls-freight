<?php

namespace Onetoweb\GlsFreight\Annotations\Readers;

use Onetoweb\GlsFreight\Annotations\Exception\TagMethodException;

/**
 * Abstract Reader.
 */
abstract class AbstractReader implements ReaderInterface
{
    /**
     * @param object $object
     * @param string $propertyName
     * @param mixed $value
     * 
     * @throws TagMethodException if setter method does not exists
     * 
     * @return void
     */
    public function setValue(object $object, string $propertyName, $value): void
    {
        // get setter method
        $method = 'set'.ucfirst($propertyName);
        
        // check for setter method
        if (!method_exists($object, $method)) {
            throw new TagMethodException("method: $method does not exist in class: $class");
        }
        
        // add value to object
        $object->{$method}($value);
    }
}