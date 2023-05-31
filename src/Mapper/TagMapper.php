<?php

namespace Onetoweb\GlsFreight\Mapper;

use Doctrine\Common\Annotations\AnnotationReader;
use Onetoweb\GlsFreight\Exception\TagException;
use Onetoweb\GlsFreight\Annotation\Tag;
use ReflectionClass;
use DateTime;

/**
 * Tag Mapper.
 */
class TagMapper
{
    /**
     * @param object $object
     *
     * @throws TagException if tag has no name
     * @throws TagException if getter method does not exists in object
     * @throws TagException if tag type is unknown
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
                
                if (!isset($tag->name)) {
                    throw new TagException("tag name is required");
                }
                
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
                
                if ($objectValue !== null) {
                    
                    // format value type
                    switch ($tag->type) {
                        
                        case Tag::TYPE_INT:
                        case Tag::TYPE_FLOAT:
                        case Tag::TYPE_STRING:
                            
                            $value = iconv('UTF-8', 'ASCII//TRANSLIT', (string) $objectValue);
                            break;
                            
                        case Tag::TYPE_DATETIME:
                            
                            if (!isset($tag->format)) {
                                throw new TagException("tag type: {$tag->type} requires a format");
                            }
                            
                            if (!$objectValue instanceof DateTime) {
                                throw new TagException("tag type: {$tag->type} needs to be a DataTime object");
                            }
                            
                            $value = $objectValue->format($tag->format);
                            break;
                            
                        case Tag::TYPE_BOOL:
                            
                            if (isset($tag->options['bool_values'])) {
                                $value = in_array($objectValue, $tag->options['bool_values']) ? array_search($objectValue, $tag->options['bool_values']) : null;
                            } else {
                                $value = null;
                            }
                            break;
                            
                        default :
                            throw new TagException("unknown type {$tag->type}");
                    }
                    
                    // add value to data
                    if ($value !== null) {
                        $data[$tag->name] = $value;
                    }
                }
            }
        }
        
        return $data;
    }
}