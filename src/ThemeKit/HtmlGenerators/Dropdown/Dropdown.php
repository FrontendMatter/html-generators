<?php namespace ThemeKit\HtmlGenerators\Dropdown;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Dropdown
 *
 * @package Mosaicpro\Dropdown
 */
class Dropdown extends WidgetCreatorAbstract
{

    /**
     * Creates a new dropdown widget
     *
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the widget class
        $this->addWidgetClass('dropdown');

        // add additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Appends to the widget content
     *
     * @param $content
     * @return $this
     */
    public function addButton($content)
    {
        $this->add($content);
        return $this;
    }

    /**
     * Adds a menu header
     * @param $item
     * @param array $args
     * @return $this
     */
    public function addMenuHeader($item, array $args = [])
    {
        $this->addMenu($item, array_merge_recursive($args, ['class' => 'dropdown-header']));
        return $this;
    }

    /**
     * Adds an active menu entry
     * @param $item
     * @param array $args
     * @return $this
     */
    public function addMenuActive($item, array $args = [])
    {
        $this->addMenu($item, array_merge_recursive($args, ['class' => 'active']));
        return $this;
    }

    /**
     * Adds a menu divider
     * @param array $args
     * @return $this
     */
    public function addMenuDivider(array $args = [])
    {
        $this->addMenu('&nbsp;', array_merge_recursive($args, ['class' => 'divider']));
        return $this;
    }

    /**
     * States if the dropdown stays in a nav, e.g. should be wrapped by a LI tag instead of DIV
     * @return $this
     */
    public function isListItem()
    {
        $this->wrap('li');
        return $this;
    }

    /**
     * States if the dropdown should be a button group
     * @return $this
     */
    public function isButtonGroup()
    {
        $this->wrap('div', ['class' => 'btn-group']);
        return $this;
    }

    /**
     * States if the dropdown menu should be aligned to right
     * @return $this
     */
    public function pullRight()
    {
        $this->isRight();
        return $this;
    }

    /**
     * Process a single menu item for output
     * @param array $item
     * @param array $args
     * @return $this
     */
    public function processItemMenu(array $item = [], array $args = [])
    {
        $args = $this->attributeAddMatchClass('active', $args);
        $this->addMenuwrapper($this->createWrapper('li', $args, $item[0]));
        return $this;
    }

    /**
     * Process the menu wrapper for output
     * @return $this
     */
    public function processMenuWrapper()
    {
        $menuWrapperClasses = ['dropdown-menu'];
        if ($this->hasRight()) $menuWrapperClasses[] = 'dropdown-menu-right';

        $menuWrapper = $this->createWrapper('ul', ['class' => implode(" ", $menuWrapperClasses)], $this->stringifyMenuwrapper());
        $this->add($menuWrapper);
        return $this;
    }

    /**
     * Process widget options
     * @return $this
     */
    public function processOptions()
    {
        if ($this->hasActive()) $this->addWidgetClass('active');
        return $this;
    }

    /**
     * Outputs the markup
     * @return string
     */
    public function __toString()
    {
        // process widget options
        $this->processOptions();

        // process the menu items
        $this->processMenu();

        // process the menu wrapper
        $this->processMenuWrapper();

        // output the widget
        return parent::__toString();
    }
}