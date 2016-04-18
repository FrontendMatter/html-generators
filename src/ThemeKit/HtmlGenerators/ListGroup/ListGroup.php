<?php namespace ThemeKit\HtmlGenerators\ListGroup;

use ThemeKit\HtmlGenerators\Core\IoC;
use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class ListGroup
 *
 * @package Mosaicpro\ListGroup
 */
class ListGroup extends WidgetCreatorAbstract
{

    /**
     * The HTML tag used for the widget wrapper
     * @var string
     */
    protected $widgetTag = 'ul';

    /**
     * Creates a new list group
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // set the widget id
        $this->addWidgetId();

        // add default widget classes
        $this->addWidgetClass('list-group');

        // add additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Processes a single list item for output
     * @param array $item
     * @param array $args
     */
    public function processItemList(array $item = [], array $args = [])
    {
        $list = $item[0];

        // add default classes
        $attributes = $this->attributeAddClass('list-group-item', $args);

        // handle badges
        if ($this->attributeMatch('badge', $args))
            $list = '<span class="badge">' . $args['badge'] . '</span> ' . $list;

        // wrap the list item
        $listWrap = $this->createWrapper('li', $attributes, $list);

        // add the list item to output
        $this->addContents($listWrap);
    }

    /**
     * Processes a single link for output
     * @param array $item
     * @param array $args
     */
    public function processItemLink(array $item = [], array $args = [])
    {
        // linked list groups belong in a div (the default is an unordered list)
        if ($this->widgetWrap !== 'div')
            $this->wrap('div');

        $url = $item[0];
        $label = $item[1];

        // add default classes
        $attributes = $this->attributeAddClass('list-group-item', $args);

        // handle active class
        $attributes = $this->attributeAddMatchClass('active', $attributes);

        // handle badges
        if ($this->attributeMatch('badge', $args))
            $label = '<span class="badge">' . $args['badge'] . '</span> ' . $label;

        // create the link
        $link = IoC::getContainer('html')->link($url, $label, $attributes);

        // decode the link to allow html in the label
        $link = IoC::getContainer('html')->decode($link);

        // add item to the output
        $this->addContents($link);
    }

    /**
     * Helper method for list group custom content
     * @param string $title
     * @param string $body
     * @return string
     */
    public static function content($title = '', $body = '')
    {
        $content = '';
        if (!empty($title)) $content .= '<h4 class="list-group-item-heading">' . $title . '</h4>';
        if (!empty($body)) $content .= '<p class="list-group-item-text">' . $body . '</p>';
        return $content;
    }

    /**
     * Outputs the markup
     * @return string
     */
    public function __toString()
    {
        // process list items
        $this->processList();

        // process link items
        $this->processLink();

        // output the widget
        return parent::__toString();
    }
}