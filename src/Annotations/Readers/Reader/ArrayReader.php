<?php

namespace Onetoweb\GlsFreight\Annotations\Readers\Reader;

use Onetoweb\GlsFreight\Annotations\Readers\AbstractReader;
use Onetoweb\GlsFreight\Annotations\TagAnnotationReader;

/**
 * Array Reader.
 */
class ArrayReader extends AbstractReader
{
    /**
     * {@inheritdoc}
     */
    public function read(array $input, string $class): object
    {
        // init class
        $object = new $class;
        
        // read tags
        (new TagAnnotationReader($class, function ($tag, $property) use ($input, $object) {
            
            if (isset($input[$tag->key]) and !empty($input[$tag->key])) {
                
                // get input value
                $value = $input[$tag->key];
                
                // set value to object
                $this->setValue($object, $property->name, $value);
            }
            
        }));
        
        return $object;
    }
}