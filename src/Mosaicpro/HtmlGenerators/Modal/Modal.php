<?php namespace Mosaicpro\HtmlGenerators\Modal;

use Mosaicpro\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Modal
 * @package Mosaicpro\HtmlGenerators\Modal
 */
class Modal extends WidgetCreatorAbstract
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
        $this->addWidgetClass('modal');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Process the widget options
     */
    public function processOptions()
    {
        $classes = ['fade'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass($class);
    }

    /**
     * Process the body
     * @return string
     */
    public function processBody()
    {
        $data = $this->getBody();
        if (!$data) return '';
        $content = $data[0];

        $args = [ 'class' => 'modal-body' ];
        $wrapper = $this->createWrapper('div', $args, $content);
        return $wrapper;
    }

    /**
     * Process the header
     * @return string
     */
    public function processHeader()
    {
        $data = $this->getTitle();
        if (!$data) return '';
        $content = $data[0];

        $button = '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $title = '<h4 class="modal-title">' . $content . '</h4>';

        $args = [ 'class' => 'modal-header' ];
        $wrapper = $this->createWrapper('div', $args, $button.$title);
        return $wrapper;
    }

    /**
     * Process the footer
     * @return string
     */
    public function processFooter()
    {
        $data = $this->getFooter();
        if (!$data) return '';
        $content = $data[0];

        $args = [ 'class' => 'modal-footer' ];
        $wrapper = $this->createWrapper('div', $args, $content);
        return $wrapper;
    }

    /**
     * Process the modal markup
     */
    public function processModal()
    {
        $modalHeader = $this->processHeader();
        $modalBody = $this->processBody();
        $modalFooter = $this->processFooter();
        $modalContent = $this->createWrapper('div', ['class' => 'modal-content'], $modalHeader . $modalBody . $modalFooter);

        $modalDialogAttributes = ['class' => 'modal-dialog'];
        $modalDialogAttributesClasses = ['sm', 'lg'];

        foreach ($modalDialogAttributesClasses as $mdac)
            if ($this->getData(ucwords($mdac)))
                $modalDialogAttributes = array_merge_recursive($modalDialogAttributes, ['class' => 'modal-' . $mdac]);

        $modalDialog = $this->createWrapper('div', $modalDialogAttributes, $modalContent);
        $this->add($modalDialog);
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processOptions();
        $this->processModal();
        return parent::__toString();
    }
}