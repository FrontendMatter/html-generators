<?php namespace Mosaicpro\HtmlGenerators\Carousel;

use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Carousel
 * @package Mosaicpro\HtmlGenerators\Carousel
 */
class Carousel extends WidgetCreatorAbstract
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
        $this->addWidgetClass('carousel slide');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * State if the carousel should display controls
     * @return $this
     */
    public function disableControls()
    {
        $this->setDisablecontrols();
        return $this;
    }

    /**
     * State if the carousel should display indicators
     * @return $this
     */
    public function disableIndicators()
    {
        $this->setDisableindicators();
        return $this;
    }

    /**
     * Make one carousel item
     * @param array $item
     * @param array $args
     */
    public function processItemItem(array $item = [], array $args = [])
    {
        $args = array_merge(['class' => 'item'], $args);
        $args = $this->attributeAddMatchClass('active', $args);
        $itemContent = $item[0];
        $captionWrapper = '';

        if (isset($args['caption']))
        {
            $caption = $args['caption'];
            $captionTitle = isset($caption[0]) ? '<h3>' . $caption[0] . '</h3>' : '';
            $captionBody = isset($caption[1]) ? '<p>' . $caption[1] . '</p>' : '';
            $captionWrapper = $this->createWrapper('div', ['class' => 'carousel-caption'], $captionTitle . $captionBody);
        }

        $wrapper = $this->createWrapper('div', $args, $itemContent . $captionWrapper);
        $this->addCarouselitem($wrapper);
    }

    /**
     * Make the carousel indicators
     * @return string
     */
    public function processIndicators()
    {
        if ($this->hasDisableindicators())
            return '';

        $data = $this->getCollection('Item');
        if (!$data) return '';

        $content = '';
        foreach($data as $k => $item)
        {
            $itemArgs = $item[1];
            $args = ['data-target' => '#' . $this->getWidgetId(), 'data-slide-to' => $k];
            if ($this->attributeMatch('active', $itemArgs)) $args = $this->attributeAddClass('active', $args);
            $content[] = $this->createWrapper('li', $args, '');
        }

        return $this->createWrapper('ol', ['class' => 'carousel-indicators'], implode("", $content));
    }

    /**
     * Make the carousel controls
     * @return string
     */
    public function processControls()
    {
        if ($this->hasDisablecontrols())
            return '';

        $controls =
        '<a class="left carousel-control" href="#' . $this->getWidgetId() . '" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#' . $this->getWidgetId() . '" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>';

        return $controls;
    }

    /**
     * Create the final carousel widget
     * @return bool
     */
    public function processCarousel()
    {
        $data = $this->getCollection('Carouselitem');
        if (!$data) return false;

        $carouselIndicators = $this->processIndicators();
        $carouselControls = $this->processControls();
        $carouselItems = $this->stringifyCarouselitem();

        $carouselInner = $this->createWrapper('div', ['class' => 'carousel-inner'], $carouselItems);
        $carousel = $carouselIndicators . $carouselInner . $carouselControls;
        $this->add($carousel);
    }

    /**
     * Set the auto-play state on page load
     * @return $this
     */
    public function isPlaying()
    {
        $this->addAttributes(['data-ride' => 'carousel']);
        return $this;
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processItem();
        $this->processCarousel();
        return parent::__toString();
    }
}