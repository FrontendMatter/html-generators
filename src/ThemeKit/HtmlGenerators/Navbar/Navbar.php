<?php namespace ThemeKit\HtmlGenerators\Navbar;

use ThemeKit\HtmlGenerators\Core\IoC;
use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Navbar
 * @package Mosaicpro\Navbar
 */
class Navbar extends WidgetCreatorAbstract
{

    /**
     * The HTML tag used for the widget wrapper
     * @var string
     */
    protected $widgetTag = "nav";

    /**
     * Holds the HTML dependency
     * @var mixed
     */
    protected static $html;

    /**
     * Create a new nav widget
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
        $this->addWidgetClass('navbar');

        // additional widget attributes
        $args = array_merge($args, ['role' => 'navigation']);
        $this->addAttributes($args);

        self::$html = IoC::getContainer('html');
    }

    /**
     * Process the container section
     */
    public function processContainer()
    {
        $class = "container";
        if ($this->hasFluid()) $class .= "-fluid";
        $this->add($this->createWrapper('div', ['class' => $class], $this->stringifyHeader() . $this->stringifyCollapse()));
    }

    /**
     * Process the header section
     */
    public function processHeader()
    {
        $toggle =
        '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#' . $this->getWidgetId() . '_collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>';

        $brand = '';
        if ($this->getBrand())
        {
            $brand = $this->getBrand();
            $brand = self::$html->decode(self::$html->link($brand[1], $brand[0], ['class' => 'navbar-brand']));
        }

        $this->addHeader($this->createWrapper('div', ['class' => 'navbar-header'], $toggle . $brand));
    }

    /**
     * Process the collapse section
     */
    public function processCollapse()
    {
        $this->addCollapse($this->createWrapper('div', ['class' => 'collapse navbar-collapse', 'id' => $this->getWidgetId() . '_collapse'], $this->stringifyNav()));
    }

    /**
     * Enable navbar fixed top
     * @return $this
     */
    public function isFixedTop()
    {
        $this->addCollectionItem(true, [], 'Fixed-top');
        return $this;
    }

    /**
     * Enable navbar fixed bottom
     * @return $this
     */
    public function isFixedBottom()
    {
        $this->addCollectionItem(true, [], 'Fixed-bottom');
        return $this;
    }

    /**
     * Enable navbar static top
     * @return $this
     */
    public function isStaticTop()
    {
        $this->addCollectionItem(true, [], 'Static-top');
        return $this;
    }

    /**
     * Process the widget options
     * @return $this
     */
    public function processOptions()
    {
        $classes = ['default', 'inverse', 'fixed-top', 'fixed-bottom', 'static-top'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass('navbar-' . $class);

        return $this;
    }

    /**
     * Helper for navbar text
     * @param string $content
     * @param bool $right
     * @return string
     */
    public static function text($content = '', $right = false)
    {
        $classes = ['navbar-text'];
        if ($right) $classes[] = 'navbar-right';
        $content = '<p class="' . implode(" ", $classes) . '">' . $content . '</p>';
        return $content;
    }

    /**
     * Alias for right aligned navbar text
     * @param string $content
     * @return string
     */
    public static function textRight($content = '')
    {
        return self::text($content, true);
    }

    /**
     * Navbar link helper
     * @param string $url
     * @param string $label
     * @param array $args
     * @return mixed
     */
    public static function link($url = '', $label = '', array $args = [])
    {
        $args = array_merge($args, ['class' => 'navbar-link']);
        return self::$html->decode(self::$html->link($url, $label, $args));
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        // process the widget options
        $this->processOptions();

        // process collapse section
        $this->processCollapse();

        // process header section
        $this->processHeader();

        // process the container
        $this->processContainer();

        // output the widget
        return parent::__toString();
    }
}