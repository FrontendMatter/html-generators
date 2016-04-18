<?php namespace ThemeKit\HtmlGenerators\Nav;

use ThemeKit\HtmlGenerators\Core\IoC;
use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Nav
 * @package ThemeKit\HtmlGenerators\Nav
 */
class Nav extends WidgetCreatorAbstract
{

    /**
     * The HTML tag used for the widget wrapper
     * @var string
     */
    protected $widgetTag = 'ul';

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
        $this->addWidgetClass('nav');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Process a single nav item
     * @param array $item
     * @param array $args
     */
    public function processItemNav(array $item = [], array $args = [])
    {
        $args = $this->attributeAddMatchClass('active', $args);
        if ($this->attributeMatch('dropdown', $args)) $element = $item[0];
        else {
            $content = $item[0];
            if (count($item) > 1)
            {
                $href = $item[0];
                if (!starts_with($href, "http")) $href = '#' . $href;
                $link_attributes = [];
                if (isset($item[2])) $link_attributes = $item[2];
                if ($this->getData('Tabs') && !isset($item[2])) $link_attributes['data-toggle'] = 'tab';
                $content = IoC::getContainer('html')->link($href, $item[1], $link_attributes);
            }

            $element = $this->createWrapper('li', $args, $content);
        }
        $this->add($element);
    }

    /**
     * Process the widget options
     * @return $this
     */
    public function processOptions()
    {
        $classes = ['tabs', 'pills', 'stacked', 'justified'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass('nav-' . $class);

        if ($this->hasNavbar()) $this->addWidgetClass('navbar-nav');
        if ($this->hasRight()) $this->addWidgetClass('navbar-right');
        return $this;
    }

    /**
     * Add a dropdown nav item
     * @param $content
     * @return $this
     */
    public function addDropdown($content)
    {
        $this->addNav($content)->isDropdown();
        return $this;
    }

    /**
     * Adds the navbar right class
     * @return $this
     */
    public function isNavbarRight()
    {
        $this->isNavbar();
        $this->isRight();
        return $this;
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        // process the widget options
        $this->processOptions();

        // process the nav items
        $this->processNav();

        // output the widget
        return parent::__toString();
    }
}