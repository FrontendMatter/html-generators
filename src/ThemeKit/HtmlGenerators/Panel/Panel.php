<?php namespace ThemeKit\HtmlGenerators\Panel;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Panel
 *
 * @package ThemeKit\HtmlGenerators\Panel
 */
class Panel extends WidgetCreatorAbstract
{

    /**
     * Create a new panel widget
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
        $this->addWidgetClass('panel');

        // add additional widget attributes
        if (is_array($args))
            $this->addAttributes($args);
        elseif (!empty($args))
            $this->addWidgetClass('panel-' . $args);
    }

    /**
     * Format the panel heading
     * @param string $content
     * @return string
     */
    public static function heading($content = '')
    {
        $content = '<div class="panel-heading">' . $content . '</div>';
        return $content;
    }

    /**
     * Format the panel body
     * @param string $content
     * @return string
     */
    public static function body($content = '')
    {
        $content = '<div class="panel-body">' . $content . '</div>';
        return $content;
    }

    /**
     * Format the panel footer
     * @param string $content
     * @return string
     */
    public static function footer($content = '')
    {
        $content = '<div class="panel-footer">' . $content . '</div>';
        return $content;
    }

    /**
     * Format the panel title
     * @param string $content
     * @param bool $size
     * @return string
     */
    public static function title($content = '', $size = false)
    {
        if (!$size) $size = 3;
        $content = '<h' . $size . ' class="panel-title">' . $content . '</h' . $size . '>';
        return $content;
    }

    /**
     * Alias for the heading method
     * @param string $content
     * @return $this
     */
    public function addHeading($content = '')
    {
        $this->add(self::heading($content));
        return $this;
    }

    /**
     * Alias for the title method
     * @param string $content
     * @param bool $size
     * @return $this
     */
    public function addTitle($content = '', $size = false)
    {
        $this->add(self::heading(self::title($content, $size)));
        return $this;
    }

    /**
     * Alias for the body method
     * @param string $content
     * @return $this
     */
    public function addBody($content = '')
    {
        $this->add(self::body($content));
        return $this;
    }

    /**
     * Alias for the footer method
     * @param string $content
     * @return $this
     */
    public function addFooter($content = '')
    {
        $this->add(self::footer($content));
        return $this;
    }

}