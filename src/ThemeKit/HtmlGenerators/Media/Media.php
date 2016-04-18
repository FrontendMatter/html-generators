<?php namespace ThemeKit\HtmlGenerators\Media;

use ThemeKit\HtmlGenerators\Core\IoC;
use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Media
 * @package ThemeKit\HtmlGenerators\Media
 */
class Media extends WidgetCreatorAbstract
{

    /**
     * Create a new media widget
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
        $this->addWidgetClass('media');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Format the media object
     * @param string $position
     * @param string $url
     * @param string $image_src
     * @param string $image_alt
     * @param array $attributes
     * @return mixed
     */
    public static function object_image($position = 'left', $url = '', $image_src = '', $image_alt = 'Image', array $attributes = [])
    {
        $html = IoC::getContainer('html');
        $image = $html->image($image_src, $image_alt, ['class' => 'media-object']);
        $link = self::object_link($position, $url, $image, $attributes);
        return $html->decode($link);
    }

    /**
     * Create a link
     * @param string $position
     * @param string $url
     * @param string $content
     * @param array $attributes
     * @return mixed
     */
    public static function object_link($position = 'left', $url = '', $content = '', array $attributes = [])
    {
        $html = IoC::getContainer('html');
        $link = $html->link($url, $content, array_merge_recursive($attributes, ['class' => 'pull-' . $position]));
        return $html->decode($link);
    }

    /**
     * Create a generic object
     * @param string $position
     * @param array $attributes
     * @param string $content
     * @return string
     */
    public function object_generic($position = 'left', array $attributes = [], $content = '')
    {
        return $this->createWrapper('div', array_merge_recursive($attributes, ['class' => 'pull-' . $position]), $content);
    }

    /**
     * Create a generic object positioned left
     * @param string $content
     * @param array $attributes
     * @return $this
     */
    public function addObjectLeft($content = '', array $attributes = [])
    {
        $this->add($this->object_generic('left', $attributes, $content));
        return $this;
    }

    /**
     * Create a generic object positioned right
     * @param string $content
     * @param array $attributes
     * @return $this
     */
    public function addObjectRight($content = '', array $attributes = [])
    {
        $this->add($this->object_generic('right', $attributes, $content));
        return $this;
    }

    /**
     * Create a link positioned left
     * @param string $url
     * @param string $content
     * @param array $attributes
     * @return $this
     */
    public function addLinkLeft($url = '', $content = '', array $attributes = [])
    {
        $this->add(self::object_link('left', $url, $content, $attributes));
        return $this;
    }

    /**
     * Create a link positioned right
     * @param string $url
     * @param string $content
     * @param array $attributes
     * @return $this
     */
    public function addLinkRight($url = '', $content = '', array $attributes = [])
    {
        $this->add(self::object_link('right', $url, $content, $attributes));
        return $this;
    }

    /**
     * Format the media body
     * @param string $title
     * @param string $content
     * @return string
     */
    public static function body($title = '', $content = '')
    {
        if ($title) $title = '<h4 class="media-heading">' . $title . '</h4>';
        return '<div class="media-body">' . $title . $content . '</div>';
    }

    /**
     * Alias for the object method
     * @param string $url
     * @param string $image_src
     * @param string $image_alt
     * @param array $attributes
     * @return $this
     */
    public function addImageLeft($url = '', $image_src = '', $image_alt = 'Image', array $attributes = [])
    {
        $this->add(self::object_image('left', $url, $image_src, $image_alt, $attributes));
        return $this;
    }

    /**
     * Alias for the object method
     * @param string $url
     * @param string $image_src
     * @param string $image_alt
     * @param array $attributes
     * @return $this
     */
    public function addImageRight($url = '', $image_src = '', $image_alt = 'Image', array $attributes = [])
    {
        $this->add(self::object_image('right', $url, $image_src, $image_alt, $attributes));
        return $this;
    }

    /**
     * Alias for the body method
     * @param string $title
     * @param string $content
     * @return $this
     */
    public function addBody($title = '', $content = '')
    {
        $this->add(self::body($title, $content));
        return $this;
    }
}