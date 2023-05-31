<?php

namespace Onetoweb\GlsFreight\Reader;

use Doctrine\Common\Annotations\AnnotationReader;
use Onetoweb\GlsFreight\Exception\TagException;
use Onetoweb\GlsFreight\Annotation\Tag;
use ReflectionClass;
use DateTime;

/**
 * Tag Reader.
 */
class TagReader
{
    /**
     * @param array $input,
     * @param string $class
     * 
     * @throws TagException if tag has no name
     * @throws TagException if setter method does not exists in class
     * @throws TagException if tag type datetime has no format
     * @throws TagException if tag type is unknown
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
            
            // set value
            $value = null;
            
            if ($tag) {
                
                if (!isset($tag->name)) {
                    throw new TagException("tag name is required");
                }
                
                // assign default
                if (isset($tag->default)) {
                    $value = $tag->default;
                }
                
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
                            
                            if (!isset($tag->format)) {
                                throw new TagException("tag type: {$tag->type} requires a format");
                            }
                            
                            $value = DateTime::createFromFormat($tag->format, $inputValue);
                            break;
                            
                        case Tag::TYPE_BOOL:
                            
                            if (isset($tag->options['bool_values'])) {
                                $value = $tag->options['bool_values'][$inputValue] ?? null;
                            } else {
                                $value = (bool) $inputValue;
                            }
                            break;
                            
                        default :
                            throw new TagException("unknown type {$tag->type}");
                    }
                }
            }
            
            // get setter method
            $method = 'set'.ucfirst($property->name);
            
            // check for setter method
            if (!$reflectionClass->hasMethod($method)) {
                throw new TagException("method: $method does not exist in class: $class");
            }
            
            // add value to object
            $object->{$method}($value);
        }
        
        return $object;
    }
}