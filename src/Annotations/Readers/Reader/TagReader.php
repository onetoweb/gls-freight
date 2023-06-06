<?php

namespace Onetoweb\GlsFreight\Annotations\Readers\Reader;

use Onetoweb\GlsFreight\Annotations\Readers\AbstractReader;
use Onetoweb\GlsFreight\Annotations\TagAnnotationReader;
use Onetoweb\GlsFreight\Annotations\Annotation\Tag;
use DateTime;

/**
 * Tag Reader.
 */
class TagReader extends AbstractReader
{
    /**
     * {@inheritdoc}
     */
    public function read(array $input, string $class): object
    {
        // init class
        $object = new $class;
        
        // read tags
        (new TagAnnotationReader($class, function($tag, $property) use ($input, $object) {
            
            if (isset($input[$tag->name]) and !empty($input[$tag->name])) {
                
                // get input vlaue
                $inputValue = $input[$tag->name];
                
                // format value type
                switch ($tag->type) {
                    
                    case Tag::TYPE_INT:
                        
                        $value = (int) $inputValue;
                        break;
                        
                    case Tag::TYPE_FLOAT:
                        
                        $value = (float) $inputValue;
                        break;
                        
                    case Tag::TYPE_STRING:
                        
                        $value = (string) $inputValue;
                        break;
                        
                    case Tag::TYPE_DATETIME:
                        
                        $value = DateTime::createFromFormat($tag->format, $inputValue);
                        break;
                        
                    case Tag::TYPE_BOOL:
                        
                        if (isset($tag->options['bool_values'])) {
                            $value = $tag->options['bool_values'][$inputValue] ?? null;
                        } else {
                            $value = (bool) $inputValue;
                        }
                        break;
                }
                
                // set value to object
                $this->setValue($object, $property->name, $value);
            }
            
        }));
        
        return $object;
    }
}