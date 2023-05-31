<?php

namespace Onetoweb\GlsFreight\Reader;

use Doctrine\Common\Annotations\AnnotationReader;
use Onetoweb\GlsFreight\Exception\TagException;
use Onetoweb\GlsFreight\Annotation\Tag;
use ReflectionClass;

/**
 * Tag Array Reader.
 */
class TagArrayReader
{
    /**
     * @param array $input,
     * @param string $class
     * 
     * @throws TagException if setter method does not exists in class
     * 
     * @return $object instanceof param class
     */
    public function read(array $input, string $class)
    {
        // init class
        $object = new $class;
        
        // get reflection class
        $reflectionClass = new ReflectionClass($class);
        
        // get class properties
        $properties = $reflectionClass->getProperties();
        
        // get annotation reader
        $reader = new AnnotationReader();
        foreach ($properties as $property) {
            
            // get property annotation
            $tag = $reader->getPropertyAnnotation($property, Tag::class);
            
            if ($tag) {
                
                if (isset($input[$tag->key])) {
                    
                    // get setter method
                    $method = 'set'.ucfirst($property->name);
                    
                    // check for setter method
                    if (!$reflectionClass->hasMethod($method)) {
                        throw new TagException("method: $method does not exist in class: $class");
                    }
                    
                    // get input value
                    $value = $input[$tag->key];
                    
                    // add value to object
                    $object->{$method}($value);
                }
            }
        }
        
        return $object;
    }
}