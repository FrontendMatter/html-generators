<?php namespace ThemeKit\HtmlGenerators\Core;

use Illuminate\Container\Container;

/**
 * Class IoC
 * @package ThemeKit\HtmlGenerators\Core
 */
class IoC
{
    /**
     * Holds the container
     * @var
     */
    protected static $container;

    /**
     * Container setter
     * @param Container $container
     */
    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    /**
     * Container getter
     * @param null $make
     * @return mixed
     */
    public static function getContainer($make = null)
    {
        if ($make) return static::$container->make($make);
        return static::$container;
    }
} 