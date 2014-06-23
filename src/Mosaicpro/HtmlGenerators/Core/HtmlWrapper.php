<?php namespace Mosaicpro\HtmlGenerators\Core;

/**
 * Class HtmlWrapper
 *
 * @package Mosaicpro\Core
 */
class HtmlWrapper implements HtmlWrapperInterface
{

    /**
     * @var
     */
    protected static $instance;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * @return array
     */
    public function getAttributesString()
    {
        return count($this->attributes) > 0 ? " " . implode(" ", $this->attributes) : "";
    }

    /**
     * @param $attributes
     * @param array $attributeKeys
     */
    public function setAttributes($attributes, $attributeKeys = [])
    {
        $this->attributes = [];
        foreach ($attributeKeys as $attributeKey)
            $this->makeAttribute($attributes, $attributeKey);
    }

    /**
     * Compose element attributes
     *
     * @param $attributes
     * @param string $attributeKey
     * @internal param string $attribute
     */
    protected function makeAttribute($attributes, $attributeKey = '')
    {
        $value = array_get($attributes, $attributeKey);
        $value = is_array($value) ? implode(" ", $value) : $value;
        $value = !empty($value) || $value === 0 ? $attributeKey . '="' . $value . '"' : false;

        if ($value) $this->attributes[] = $value;
    }

    /**
     * Create a HTML wrapper
     * @param $element
     * @param $attributes
     * @param string $content
     * @return string
     */
    public function createWrapper($element, $attributes, $content = '')
    {
        $filters = [
            'id',
            'class',
            'role',
            'style',
            'type',
            'name',
            'value',
            'checked',
            'selected',
            'data-toggle',
            'data-parent',
            'data-target',
            // Carousel
            'data-slide-to',
            'data-ride',
            // ProgressBar
            'aria-valuenow',
            'aria-valuemin',
            'aria-valuemax',
            // tables
            'colspan'
        ];
        $this->setAttributes($attributes, $filters);
        $attributes = $this->getAttributesString();

        $filters_selfclosing = ['input'];
        $selfclosing = in_array($element, $filters_selfclosing);

        return '<' . $element . $attributes . (!$selfclosing ? '' : '/') . '>' .
                $content .
                ($selfclosing ? '' : '</' . $element . '>') . PHP_EOL;
    }

    /**
     * Handle dynamic method calls
     *
     * @param $name
     * @param $args
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        $args = empty($args) ? [] : $args[0];

        $instance = static::$instance;
        if ( !$instance ) $instance = static::$instance = new static($name, $args);

        return $instance;

    }
}