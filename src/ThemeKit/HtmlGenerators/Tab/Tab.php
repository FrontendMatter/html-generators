<?php namespace ThemeKit\HtmlGenerators\Tab;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Tab
 * @package ThemeKit\HtmlGenerators\Tab
 */
class Tab extends WidgetCreatorAbstract
{

    /**
     * Create a new Modal widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the default widget classes
        $this->addWidgetClass('tab-content');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Process a single Tab pane
     * @param array $item
     * @param array $args
     * @return bool
     */
    public function processItemTab(array $item = [], array $args = [])
    {
        if (count($item) < 2) return false;

        $id = $item[0];
        $content = $item[1];

        $args = array_merge(['id' => $id, 'class' => 'tab-pane'], $args);
        $args = $this->attributeAddMatchClass('active', $args);
        if ($this->hasFade())
        {
            $args = $this->attributeAddClass('fade', $args);
            if ($this->attributeMatch('active', $args))
                $args = $this->attributeAddClass('in', $args);
        }

        $wrapper = $this->createWrapper('div', $args, $content);
        $this->add($wrapper);
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processTab();
        return parent::__toString();
    }
}