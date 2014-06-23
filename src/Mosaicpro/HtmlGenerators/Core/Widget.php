<?php namespace Mosaicpro\HtmlGenerators\Core;

/**
 * Class Widget
 * @package Mosaicpro\Core
 */
class Widget extends WidgetCreatorAbstract
{

    /**
     * Create a new widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the widget id
        $this->addWidgetId();

        // add additional widget attributes
        $this->addAttributes($args);
    }
}