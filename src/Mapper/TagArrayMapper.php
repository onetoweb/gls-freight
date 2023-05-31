<?php

namespace Onetoweb\GlsFreight\Mapper;

use Doctrine\Common\Annotations\AnnotationReader;
use Onetoweb\GlsFreight\Exception\TagException;
use Onetoweb\GlsFreight\Annotation\Tag;
use ReflectionClass;

/**
 * Tag Array Mapper.
 */
class TagArrayMapper
{
    /**
     * @param object $object
     * 
     * @throws TagException if getter method does not exists in object
     * 
     * @return array with mapped data
     */
    public function map($object): array
    {
        // set data array
        $data = [];
        
        // get reflection class
        $reflectionClass = new ReflectionClass($object);
        
        // get class properties
        $properties = $reflectionClass->getProperties();
        
        // get annotation reader
        $reader = new AnnotationReader();
        foreach ($properties as $property) {
            
            // get property annotation
            $tag = $reader->getPropertyAnnotation($property, Tag::class);
            
            // set value
            $value = null;
            
            if ($tag) {
                
                // get property name
                $propertyName = ucfirst($property->name);
                
                // get getter method
                if ($reflectionClass->hasMethod("get$propertyName")) {
                    $method = "get$propertyName";
                } elseif ($reflectionClass->hasMethod("is$propertyName")) {
                    $method = "is$propertyName";
                } else {
                    throw new TagException("neither method get$propertyName or is$propertyName exist in class: ".get_class($object));
                }
                
                // get value
                $objectValue = $object->{$method}();
                
                // add value to data array
                $data[$tag->key] = $objectValue;
            }
        }
        
        return $data;
    }
}