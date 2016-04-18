<?php namespace ThemeKit\HtmlGenerators\Table;

use ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract;

/**
 * Class Table
 * @package ThemeKit\HtmlGenerators\Table
 */
class Table extends WidgetCreatorAbstract
{

    /**
     * The HTML tag used for the widget wrapper
     * @var string
     */
    protected $widgetTag = "table";

    /**
     * Create a new Table widget
     * @param $name
     * @param array $args
     */
    public function __construct($name, $args)
    {
        // create a default widget
        parent::__construct($name, $args);

        // add the default widget classes
        $this->addWidgetClass('table');

        // additional widget attributes
        $this->addAttributes($args);
    }

    /**
     * Process the widget options
     */
    public function processOptions()
    {
        $classes = ['striped', 'hover', 'condensed', 'bordered'];
        foreach ($classes as $class)
            if ($this->getData(ucwords($class))) $this->addWidgetClass('table-' . $class);
    }

    /**
     * State if the table data is orderable
     * @return bool
     */
    public function canOrder()
    {
        $body = $this->getBody();
        $header = $this->getHeader();
        return $this->getOrder() && !isset($body[0][0]) && !isset($header[0][0]);
    }

    /**
     * State if the table data can be hidden
     * @return bool
     */
    public function canHide()
    {
        $header = $this->getHeader();
        $hidden = $this->getHidden();
        return $this->getHidden() && isset($header[0][0]) && is_int($hidden[0]);
    }

    /**
     * Process the custom columns
     * @param array $item
     * @param bool $header
     * @return array
     */
    public function processAdditionalColumns(array $item, $header = false)
    {
        // additional columns
        $acolumnsCollection = $this->getCollection('Column');
        if ($acolumnsCollection)
        {
            foreach($acolumnsCollection as $acolumn)
            {
                $acolumnKey = strtolower(implode("-", str_word_count($acolumn[0][0], 1)));
                if ($header)
                    $item[$acolumnKey] = $acolumn[0][0];
                else
                    $item[$acolumnKey] = $acolumn[0][1];
            }
        }
        return $item;
    }

    /**
     * Process the table header
     * @param array $item
     * @param array $args
     */
    public function processItemHeader(array $item = [], array $args = [])
    {
        if (isset($item[0]) && $item[0] === false) return;
        $item = $this->processAdditionalColumns($item, true);

        // formatting
        $itemFormat = [];
        foreach ($item as $k => $v)
        {
            if (is_int($k)) $itemFormat[$v] = $v;
            else $itemFormat[$k] = $v;
        }
        $item = $itemFormat;

        if ($this->canOrder())
            $item = array_merge(array_flip($this->getOrder()), $item);

        $columns = [];

        if ($this->canHide())
            $hidden = $this->getHidden();

        foreach($item as $column => $value)
        {
            if ($this->canHide() && is_array($hidden))
            {
                $key = $column;
                if (is_numeric($column)) $key = $value;
                if (!is_numeric($column)) $key = array_search($column, array_keys($item), true);
                if (in_array($key, $hidden, true) || in_array($column, $hidden, true))
                {
                    $hiddenKey = $key;
                    if (is_numeric($column)) $hiddenKey = array_search($key, array_keys($item), true);
                    $this->addHiddenkeys($hiddenKey);
                    continue;
                }
            }
            $attributes = [];
            $attributes['class'] = "table-th-" . strtolower(implode("-", str_word_count($column, 1)));

            if (isset($args[$column]))
                $attributes = array_merge($attributes, $args[$column]);

            $columns[] = $this->createWrapper('th', $attributes, $value);
        }

        $row = $this->createWrapper('tr', [], implode("", $columns));
        $thead = $this->createWrapper('thead', [], $row);
        $this->add($thead);
    }

    /**
     * Process the table body
     * @param array $item
     * @param array $args
     */
    public function processItemBody(array $item = [], array $args = [])
    {
        $header = $this->getHeader();
        $hidden = $this->getHidden();
        $isOrderable = $this->canOrder();
        $order = $this->getOrder();

        if ($this->canHide())
        {
            $hiddenkeysCollection = $this->getCollection('Hiddenkeys');
            $hiddenkeys = [];
            if ($hiddenkeysCollection)
            {
                foreach ($hiddenkeysCollection as $hiddenKey)
                    $hiddenkeys[] = $hiddenKey[0][0];
            }
        }

        if (!$header && !isset($item[0][0]))
            $headerColumns = [];

        // colspan
        $rows_columns = [];
        foreach($item as $row)
        {
            $row = $this->processAdditionalColumns($row);
            $rows_columns[] = count($row);
        }
        $max_columns = max($rows_columns);

        $rows = [];
        foreach($item as $row)
        {
            $row = $this->processAdditionalColumns($row);
            $data = $row;

            if (method_exists($row, 'toArray')) $data = $row->toArray();
            if ($isOrderable) $data = array_merge(array_flip($order), $data);

            $columns = [];

            // colspan
            $row_columns = count($data);
            $columns_diff = $max_columns - $row_columns;
            $current_column = 0;

            foreach($data as $column => $value)
            {
                if ($this->canHide() && is_array($hidden))
                {
                    if (is_numeric($column)) $keyPosition = $column;
                    else $keyPosition = array_search($column, array_keys($data));
                    if ($hiddenkeys && is_array($hiddenkeys) && in_array($keyPosition, $hiddenkeys, true))
                        continue;
                    elseif (in_array($column, $hidden, true))
                        continue;
                }

                $current_column++;

                if (is_array($value))
                {
                    $content = [];
                    foreach($value as $v)
                    {
                        if (is_subclass_of($v, 'ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract'))
                            $content[] = $this->bindWidget($v, $row);
                        else
                            $content[] = $this->bindData($v, $row);
                    }
                    $value = implode(PHP_EOL, $content);
                }
                else
                {
                    if (is_subclass_of($value, 'ThemeKit\HtmlGenerators\Core\WidgetCreatorAbstract'))
                        $value = $this->bindWidget($value, $row);
                }

                $attributes = [];
                if ($current_column == $row_columns && $columns_diff > 0) $attributes['colspan'] = $columns_diff + 1;
                $attributes['class'] = "table-td-" . strtolower(implode("-", str_word_count($column, 1)));

                if (isset($args[$column]))
                    $attributes = array_merge($attributes, $args[$column]);

                $columns[] = $this->createWrapper('td', $attributes, $value);
                if (isset($headerColumns)) $headerColumns[] = $column;
            }
            $rows[] = $this->createWrapper('tr', [], implode("", $columns));
        }
        $tbody = $this->createWrapper('tbody', [], implode("", $rows));

        // attempt to generate header
        if (isset($headerColumns))
        {
            $this->addHeader($headerColumns, $args);
            $this->processHeader();
        }

        $this->add($tbody);
    }

    /**
     * Output the markup
     * @return string
     */
    public function __toString()
    {
        $this->processOptions();
        $this->processHeader();
        $this->processBody();
        return parent::__toString();
    }
}