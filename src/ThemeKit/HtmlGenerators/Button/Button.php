<?php namespace ThemeKit\HtmlGenerators\Button;

use ThemeKit\HtmlGenerators\Core\IoC;
use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Button
 *
 * @package Mosaicpro\Button
 */
class Button extends WidgetCreatorAbstract
{

    /**
     * Holds the URL of the button
     * @var string
     */
    protected $url = '#';

    /**
     * The button's classes
     * @var array
     */
    protected $style = ['btn'];

    /**
     * The button's label
     * @var string
     */
    protected $label = 'Button';

    /**
     * States if the widget should be wrapped or not
     * @var bool
     */
    protected $widgetWrap = false;

    /**
     * Creates a new button
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        if ($name == 'regular') $name = 'default';
        $this->style[] = "btn-" . $name;
        $this->label = $args;
    }

    /**
     * Adds a URL to the button
     * @param $url
     * @return $this
     */
    public function addUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Makes the button a dropdown toggle
     * @return $this
     */
    public function isDropdown()
    {
        $this->isCaret();
        $this->addAttributes(['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
        return $this;
    }

    /**
     * Makes the button a regular link
     * @return $this
     */
    public function isLink()
    {
        $this->style = [];
        return $this;
    }

    /**
     * Helper for right aligned navbar buttons
     * @return $this
     */
    public function isNavbarRight()
    {
        $this->isRight();
        $this->isNavbar();
        return $this;
    }

    /**
     * Helper for disabling buttons
     * @return $this
     */
    public function isDisabled()
    {
        $this->addAttributes(['disabled' => 'disabled']);
        return $this;
    }

    /**
     * Set up the button to open a modal
     * @param $modal
     * @return $this
     */
    public function openModal($modal)
    {
        $this->addAttributes([
            'data-toggle' => 'modal',
            'data-target' => $modal
        ]);
        return $this;
    }

    /**
     * Set up the button to close a modal
     * @return $this
     */
    public function dismissModal()
    {
        $this->addAttributes(['data-dismiss' => 'modal']);
        return $this;
    }

    /**
     * Adds the markup for output
     * @return $this
     */
    public function processItem()
    {
        if ($this->hasCaret())
            $this->label .= ' <span class="caret"></span>';

        $attributes = $this->getAttributes();

        foreach($this->style as $style)
            $attributes = $this->attributeAddClass($style, $attributes);

        if ($this->getData('Class'))
            $attributes = $this->attributeAddClass($this->getData('Class'), $attributes);

        if ($this->hasNavbar())
            $attributes = $this->attributeAddClass('navbar-btn', $attributes);

        if ($this->hasRight() && $this->hasNavbar())
            $attributes = $this->attributeAddClass('navbar-right', $attributes);

        $classes = ['primary', 'success', 'info', 'danger', 'warning', 'default', 'block', 'xs', 'sm', 'lg'];
        foreach($classes as $class)
            if ($this->handleDynamicHasState(ucwords($class)))
                $attributes = $this->attributeAddClass('btn-' . $class, $attributes);

        // create the button
        if ($this->hasButton())
            $button = IoC::getContainer('form')->button($this->label, $attributes);

        elseif ($this->hasSubmit())
            $button = IoC::getContainer('form')->submit($this->label, $attributes);

        else
            $button = IoC::getContainer('html')->decode(IoC::getContainer('html')->link($this->url, $this->label, $attributes));

        // add the button to output
        $this->add($button);
    }

    /**
     * Outputs the markup
     * @return string
     */
    public function __toString()
    {
        $this->processItem();
        return parent::__toString();
    }
}