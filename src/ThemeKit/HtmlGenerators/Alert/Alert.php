<?php namespace ThemeKit\HtmlGenerators\Alert;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Alert
 * @package ThemeKit\HtmlGenerators\Alert
 */
class Alert extends WidgetCreatorAbstract
{

    /**
     * Create a new alert widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the widget id
        $this->addWidgetId();

        // add the default widget classes
        $this->addWidgetClass('alert');

        // additional widget attributes
        $this->addAttributes($args);
    }

    public function processItemAlert(array $item = [], $args = [])
    {
        $content = $item[0];
        $classes = ['success', 'info', 'warning', 'danger'];
        foreach ($classes as $class)
            $args = $this->attributeAddMatchClass('alert-' . $class, $args, $class, true);

        if ($this->attributeMatch('dismissable', $args))
        {
            $this->addWidgetClass('alert-dismissable');
            $content = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $content;
        }

        $this->addAttributes($args);
        $this->add($content);
    }

    public function __toString()
    {
        $this->processAlert();
        return parent::__toString();
    }
}