<?php namespace Mosaicpro\HtmlGenerators\ButtonGroup;

use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class ButtonGroup
 * @package Mosaicpro\ButtonGroup
 */
class ButtonGroup extends WidgetCreatorAbstract
{

    /**
     * Create a new Button Group widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the default widget classes
        $this->addWidgetClass('btn-group');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Process the widget options
     */
    public function processOptions()
    {
        $classes = ['vertical', 'justified', 'xs', 'sm', 'lg'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass('btn-group-' . $class);
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processOptions();
        return parent::__toString();
    }
}