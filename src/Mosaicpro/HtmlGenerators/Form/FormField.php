<?php namespace Mosaicpro\HtmlGenerators\Form;

use Mosaicpro\HtmlGenerators\Core\IoC;

/**
 * Class FormField
 * @package Mosaicpro\HtmlGenerators\Form
 */
class FormField
{

    /**
     * @var Mosaicpro\HtmlGenerators\Form\FormField
     */
    protected static $instance;

    /**
     * Make the form field
     *
     * @param $name
     * @param array $args
     * @return mixed
     */
    public function make($name, array $args)
    {
        $wrapper = $this->createWrapper();
        $field = $this->createField($name, $args);

        return str_replace('{{FIELD}}', $field, $wrapper);
    }

    /**
     * Prepare a wrapping container for the field
     *
     * @return string
     */
    protected function createWrapper()
    {
        $wrapper = IoC::getContainer('config')->get('html-generators::FormField.wrapper');
        $wrapperClass = IoC::getContainer('config')->get('html-generators::FormField.wrapperClass');

        return '<' . $wrapper . ' class="' . $wrapperClass . '">{{FIELD}}</' . $wrapper . '>';
    }

    /**
     * Manage creation of the form field
     *
     * @param $name
     * @param $args
     * @return string
     */
    protected function createField($name, $args)
    {
        $type = array_get($args, 'type') ?: $this->guessInputType($name);
        $args = array_merge(['class' => IoC::getContainer('config')->get('html-generators::FormField.inputClass')], $args);
        $field = $this->createLabel($name, $args);

        unset($args['label']);
        return $field .= $this->createInput($type, $name, $args);
    }

    /**
     * Manage creation of the label
     *
     * @param $name
     * @param $args
     * @return string
     */
    protected function createLabel($name, $args)
    {
        $label = array_get($args, 'label');

        is_null($label) and $label = $this->prettifyFieldName($name) . ': ';
        return $label ? IoC::getContainer('form')->label($name, $label, array('class' => 'control-label')) : '';
    }

    /**
     * Manage creation of the input
     *
     * @param $type
     * @param $name
     * @param $args
     * @return mixed
     */
    protected function createInput($type, $name, $args)
    {
        return $type == 'password' ?
            IoC::getContainer('form')->password($name, $args) :
            IoC::getContainer('form')->$type($name, null, $args);
    }

    /**
     * Guess the input type
     *
     * @param $name
     * @return string
     */
    protected function guessInputType($name)
    {
        return array_get(IoC::getContainer('config')->get('html-generators::FormField.guessInputType'), $name) ?: 'text';
    }

    /**
     * Format the field name for the label
     *
     * @param $name
     * @return string
     */
    protected function prettifyFieldName($name)
    {
        return ucwords(preg_replace('/(?<=\w)(?=[A-Z])/', " $1", $name));
    }

    /**
     * Handle dynamic method calls
     *
     * @param $name
     * @param $args
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        $args = empty($args) ? [] : $args[0];

        $instance = static::$instance;
        if ( !$instance ) $instance = static::$instance = new static;

        return $instance->make($name, $args);

    }
}