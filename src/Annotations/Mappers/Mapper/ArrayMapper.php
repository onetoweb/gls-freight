<?php

namespace Onetoweb\GlsFreight\Annotations\Mappers\Mapper;

use Onetoweb\GlsFreight\Annotations\Mappers\AbstractMapper;
use Onetoweb\GlsFreight\Annotations\TagAnnotationReader;

/**
 * Array Mapper.
 */
class ArrayMapper extends AbstractMapper
{
    /**
     * {@inheritdoc}
     */
    public function map(object $object): array
    {
        // set data array
        $data = [];
        
        // read tags
        (new TagAnnotationReader(get_class($object), function ($tag, $property) use (&$data, $object) {
            
            // get value from object
            $value = $this->getValue($object, $property->name);
            
            if ($value !== null) {
                
                // add value to data array
                $data[$tag->key] = $value;
            }
            
        }));
        
        return $data;
    }
}