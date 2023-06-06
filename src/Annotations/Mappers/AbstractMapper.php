<?php

namespace Onetoweb\GlsFreight\Annotations\Mappers;

use Onetoweb\GlsFreight\Annotations\Exception\TagMethodException;

/**
 * Abstract Mapper.
 */
abstract class AbstractMapper implements MapperInterface
{
    /**
     * @param object $object
     * @param string $propertyName
     * 
     * @throws TagMethodException if getter method does not exists
     * 
     * @return mixed
     */
    public function getValue(object $object, string $propertyName)
    {
        // get property name
        $propertyName = ucfirst($propertyName);
        
        // get getter method
        if (method_exists($object, "get$propertyName")) {
            $method = "get$propertyName";
        } elseif (method_exists($object, "is$propertyName")) {
            $method = "is$propertyName";
        } else {
            throw new TagMethodException("neither method get$propertyName or is$propertyName exist in class: ".get_class($object));
        }
        
        // get value
        return $object->{$method}();
    }
}