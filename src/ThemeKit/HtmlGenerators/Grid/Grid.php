<?php namespace ThemeKit\HtmlGenerators\Grid;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Grid
 *
 * @package ThemeKit\HtmlGenerators\Grid
 */
class Grid extends WidgetCreatorAbstract
{

    /**
     * Create a new Grid widget
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
        $this->addWidgetClass('row');

        // add custom attributes
        $this->addAttributes($args);
    }

    /**
     * @param $size
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function column($size, $content = '', array $attributes = [])
    {
        $defaults = ['class' => 'col-md-' . $size];
        $attributes = array_merge_recursive($defaults, $attributes);
        $content = self::getInstance()->createWrapper('div', $attributes, $content);
        return $content;
    }

    /**
     * @param $size
     * @param string $content
     * @param array $attributes
     * @return $this
     */
    public function addColumn($size, $content = '', array $attributes = [])
    {
        $this->add(self::column($size, $content, $attributes));
        return $this;
    }

}