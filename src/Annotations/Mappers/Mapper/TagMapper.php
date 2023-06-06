<?php

namespace Onetoweb\GlsFreight\Annotations\Mappers\Mapper;

use Onetoweb\GlsFreight\Annotations\Mappers\AbstractMapper;
use Onetoweb\GlsFreight\Annotations\TagAnnotationReader;
use Onetoweb\GlsFreight\Annotations\Annotation\Tag;
use DateTime;

/**
 * Tag Mapper.
 */
class TagMapper extends AbstractMapper
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
            $objectValue = $this->getValue($object, $property->name);
            
            if ($objectValue !== null) {
                
                // format value type
                switch ($tag->type) {
                    
                    case Tag::TYPE_INT:
                    case Tag::TYPE_FLOAT:
                    case Tag::TYPE_STRING:
                        
                        $value = iconv('UTF-8', 'ASCII//TRANSLIT', (string) $objectValue);
                        break;
                        
                    case Tag::TYPE_DATETIME:
                        
                        $value = $objectValue->format($tag->format);
                        break;
                        
                    case Tag::TYPE_BOOL:
                        
                        if (isset($tag->options['bool_values'])) {
                            $value = in_array($objectValue, $tag->options['bool_values']) ? array_search($objectValue, $tag->options['bool_values']) : null;
                        } else {
                            $value = null;
                        }
                        break;
                }
                
                // add value to data
                if ($value !== null) {
                    $data[$tag->name] = $value;
                }
            }
            
        }));
        
        return $data;
    }
}