<?php namespace Mosaicpro\HtmlGenerators\ButtonGroup;

use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class ButtonToolbar
 * @package Mosaicpro\ButtonGroup
 */
class ButtonToolbar extends WidgetCreatorAbstract
{

    /**
     * Create a new Button Toolbar widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the default widget classes
        $this->addWidgetClass('btn-toolbar');

        // additional widget attributes
        $this->addAttributes($args);
    }
}