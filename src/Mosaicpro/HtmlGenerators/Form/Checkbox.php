<?php namespace Mosaicpro\HtmlGenerators\Form;

use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Checkbox
 * @package Mosaicpro\HtmlGenerators\Form
 */
class Checkbox extends WidgetCreatorAbstract
{
    /**
     * Holds the checkbox name
     * @var
     */
    protected $args;

    /**
     * Create a widget
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        $this->name = $name;
        $this->args = $args;
    }

    /**
     * Create the checkbox
     * @return string
     */
    public function processCheckbox()
    {
        $attributes = array_merge([
            'type' => 'checkbox',
            'name' => $this->args,
            'value' => 1
        ], $this->getAttributes());

        return $this->createWrapper('input', $attributes, '');
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        return $this->processCheckbox();
    }
}