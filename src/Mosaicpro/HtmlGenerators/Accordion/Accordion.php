<?php namespace Mosaicpro\HtmlGenerators\Accordion;

use Mosaicpro\HtmlGenerators\Core\IoC;
use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Accordion
 *
 * @package Mosaicpro\Accordion
 */
class Accordion extends WidgetCreatorAbstract
{

    /**
     * Creates a new accordion widget
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
        $this->addWidgetClass('panel-group');

        // add additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Handles the processing of an accordion item
     * @param array $item
     * @param array $args
     */
    public function processItemAccordion(array $item = [], array $args = [])
    {
        $title = isset($item[0]) ? $item[0] : '';
        $body = isset($item[1]) ? $item[1] : '';

        // the default accordion body classes
        $widgetBodyClass = ['panel-collapse', 'panel-body', 'collapse'];

        // if this accordion item is active, add an extra class to the accordion body
        if ($this->attributeMatch('active', $args)) $widgetBodyClass[] = 'in';

        // prepare the accordion body classes
        $widgetBodyClass = implode(" ", $widgetBodyClass);

        // give the accordion item an identifier
        $widgetItemId = $this->getWidgetId()  . '_Item' . count($this->getCollection('Contents'));

        // create the accordion item content
        $widgetHeadingLinkAttributes = ['class' => 'accordion-toggle', 'data-toggle' => 'collapse'];
        if (!$this->hasCollapsible()) $widgetHeadingLinkAttributes = array_merge_recursive($widgetHeadingLinkAttributes, ['data-parent' => '#' . $this->getWidgetId()]);

        // create the accordion item content
        $widgetHeadingLink = IoC::getContainer('html')->link('#' . $widgetItemId, $title, $widgetHeadingLinkAttributes);
        $widgetHeading = $this->createWrapper('h4', ['class' => 'panel-title'], $widgetHeadingLink);
        $widgetHeadingWrapper = $this->createWrapper('div', ['class' => 'panel-heading'], $widgetHeading);
        $widgetBodyWrapper = $this->createWrapper('div', ['class' => $widgetBodyClass, 'id' => $widgetItemId], $body);
        $widgetItem = $this->createWrapper('div', ['class' => 'panel panel-default'], $widgetHeadingWrapper . $widgetBodyWrapper);

        // add the accordion item to the accordion
        $this->add($widgetItem);
    }

    /**
     * Outputs the markup
     * @return string
     */
    public function __toString()
    {
        // process the accordion items for output
        $this->processAccordion();

        // output the widget
        return parent::__toString();
    }
}