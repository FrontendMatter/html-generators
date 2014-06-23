<?php namespace Mosaicpro\HtmlGenerators\Core;

/**
 * Interface HtmlWrapperInterface
 *
 * @package Mosaicpro\Core
 */
interface HtmlWrapperInterface
{
    /**
     * @param $element
     * @param $attributes
     * @param string $content
     * @return mixed
     */
    public function createWrapper($element, $attributes, $content = '');
} 