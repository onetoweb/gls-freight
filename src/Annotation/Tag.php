<?php

namespace Onetoweb\GlsFreight\Annotation;

/**
 * @Annotation
 */
final class Tag
{
    /**
     * Types.
     */
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';
    const TYPE_DATETIME = 'datetime';
    const TYPE_BOOL = 'bool';
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $key;
    
    /**
     * @var string
     */
    public $type;
    
    /**
     * @var string
     */
    public $default;
    
    /**
     * @var string
     */
    public $format;
    
    /**
     * @var array
     */
    public $options;
    
    /**
     * @return string[]
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_INT,
            self::TYPE_FLOAT,
            self::TYPE_STRING,
            self::TYPE_DATE_TIME,
            self::TYPE_BOOL
        ];
    }
}