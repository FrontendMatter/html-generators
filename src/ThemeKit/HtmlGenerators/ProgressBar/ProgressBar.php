<?php namespace ThemeKit\HtmlGenerators\ProgressBar;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class ProgressBar
 * @package ThemeKit\HtmlGenerators\ProgressBar
 */
class ProgressBar extends WidgetCreatorAbstract
{

    /**
     * Create a new Progress Bar widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the default widget classes
        $this->addWidgetClass('progress');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Set the striped and animated state
     * @return $this
     */
    public function isAnimated()
    {
        $this->isStriped();
        $this->isActive();
        return $this;
    }

    /**
     * Process the widget options
     */
    public function processOptions()
    {
        $classes = ['striped'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass('progress-' . $class);

        if ($this->hasActive())
            $this->addWidgetClass('active');
    }

    /**
     * Process a single Bar item in the ProgressBar Widget
     * @param array $item
     * @param array $args
     */
    public function processItemBar(array $item = [], array $args = [])
    {
        $value = isset($item[0]) ? $item[0] : false;
        $label = isset($item[1]) ? $item[1] : false;
        $label = isset($args['label']) ? $args['label'] : $label;
        if (!$value) $value = $this->getValue();
        if (!$label) $label = $this->getLabel();

        $argsDefault = [
            'class' => 'progress-bar',
            'style' => 'width: ' . $value . '%;',
            'role' => 'progressbar',
            'aria-valuenow' => $value,
            'aria-valuemin' => 0,
            'aria-valuemax' => 100
        ];
        $args = array_merge($argsDefault, $args);
        $classes = ['success', 'info', 'warning', 'danger'];
        foreach($classes as $class)
            $args = $this->attributeAddMatchClass('progress-bar-' . $class, $args, $class);

        $wrapper = $this->createWrapper('div', $args, $label);
        $this->add($wrapper);
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processOptions();

        if (count($this->getCollection('Bar')) === 0)
            $this->addBar();

        $this->processBar();
        return parent::__toString();
    }
}