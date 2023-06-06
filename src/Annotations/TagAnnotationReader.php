<?php

namespace Onetoweb\GlsFreight\Annotations;

use Onetoweb\GlsFreight\Annotations\Annotation\Tag;
use Onetoweb\GlsFreight\Annotations\Exception\TagAnnotationReadException;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;

/**
 * Tag Annotation Reader.
 */
class TagAnnotationReader
{
    /**
     * @param string $class
     * @param callable $callback
     */
    public function __construct(string $class, callable $callback)
    {
        $this->class = $class;
        $this->callback = $callback;
        $this->getTagProperties();
    }
    
    /**
     * @throws TagAnnotationReadException if tag has no name
     * @throws TagAnnotationReadException if tag has no key
     * @throws TagAnnotationReadException if tag has no type
     * @throws TagAnnotationReadException if tag has invalid type
     * @throws TagAnnotationReadException if tag type has invalid options
     * 
     * @return void
     */
    private function getTagProperties(): void
    {
        // get reflection class
        $reflectionClass = new ReflectionClass($this->class);
        
        // get class properties
        $properties = $reflectionClass->getProperties();
        
        // get annotation reader
        $reader = new AnnotationReader();
        foreach ($properties as $property) {
            
            // get property annotation
            $tag = $reader->getPropertyAnnotation($property, Tag::class);
            
            if ($tag) {
                
                // check required field name
                if (!isset($tag->name)) {
                    throw new TagAnnotationReadException("tag name is required");
                }
                
                // check required field key
                if (!isset($tag->key)) {
                    throw new TagAnnotationReadException("tag key is required");
                }
                
                // check required field type
                if (!isset($tag->type)) {
                    throw new TagAnnotationReadException("tag type is required");
                }
                
                // check field type
                if (!in_array($tag->type, Tag::getTypes())) {
                    throw new TagAnnotationReadException("unkown tag type: {$tag->type} tag types: ".Tag::getTypes());
                }
                
                // check format of field type datetime
                if ($tag->type === Tag::TYPE_DATETIME and !isset($tag->format)) {
                    throw new TagAnnotationReadException("tag type: {$tag->type} requires a format");
                }
                
                ($this->callback)($tag, $property);
            }
        }
    }
}