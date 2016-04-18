<?php namespace ThemeKit\HtmlGenerators\Core;

/**
 * Class WidgetCreatorAbstract
 *
 * @package ThemeKit\HtmlGenerators\Core
 */
abstract class WidgetCreatorAbstract extends HtmlWrapper
{

    /**
     * Holds the name of the call the widget was initialized with
     * @var string
     */
    protected $name = '';


    /**
     * Holds the widget identifier
     * @var null
     */
    protected $id = null;

    /**
     * Holds an instance of the WidgetCreatorAbstract
     * @var
     */
    protected static $instance;

    /**
     * The HTML tag used for the widget wrapper
     * @var string
     */
    protected $widgetTag = 'div';

    /**
     * States if the widget should be wrapped or not
     * @var bool
     */
    protected $widgetWrap = true;

    /**
     * Holds the widget items
     * @var array
     */
    protected $collection = [];

    /**
     * Holds a reference to the last called collection key
     * @var null
     */
    protected $lastCollectionKey = null;

    /**
     * Creates a new widget
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        $this->name = $name;

        // add the widget id
        $this->addWidgetId();
    }

    /**
     * Returns the widget type
     * @return mixed
     */
    public function getWidgetType()
    {
        $class = explode('\\', get_called_class());
        return end($class);
    }

    /**
     * Returns the widget id
     * @return string
     */
    public function getWidgetId()
    {
        return $this->id;
    }

    /**
     * Sets the widget id
     * @param bool $id
     * @param bool $make
     * @return $this
     */
    public function addWidgetId($id = false, $make = false)
    {
        if (!$id || $make)
        {
            if ($this->name == 'make' || $make === true)
                $id = $this->getWidgetType() . '_' . $this->getUnique();
            else
                $id = $this->getWidgetType() . '_' . $this->name;
        }

        $this->id = $id;
        $this->addAttributes(['id' => $id]);
        return $this;
    }

    /**
     * Generate random string
     * @return string
     */
    public function getUnique()
    {
        return md5(microtime().rand());
    }

    /**
     * Adds a widget class
     * @param $class
     * @return $this
     */
    public function addWidgetClass($class)
    {
        $this->addAttributes(['class' => $class]);
        return $this;
    }

    /**
     * Adds data to collection
     * @param $data
     * @param $args
     * @param $key
     * @param bool $reset
     * @return $this
     */
    public function addCollectionItem($data, $args, $key, $reset = false)
    {
        $data = [$data, $args];
        $this->saveData($key, $data, $reset);
        return $this;
    }

    /**
     * Updates data in collection
     * @param $data
     * @param $args
     * @param $key
     * @return $this
     */
    public function updateCollection($data, $args, $key)
    {
        return $this->addCollectionItem($data, $args, $key, true);
    }

    /**
     * Saves data in collection
     * @param $key
     * @param $data
     * @param bool $reset
     * @return $this
     */
    public function saveData($key, $data, $reset = false)
    {
        if (empty($data))
            return $this;

        if ($reset)
            $this->collection[$key] = [];

        $this->collection[$key][] = $data;
        return $this;
    }

    /**
     * Gets data in collection, without the args
     * @param $key
     * @return bool
     */
    public function getData($key)
    {
        $collection = $this->getCollection($key);
        if (!$collection) return null;

        return $collection[0][0];
    }

    /**
     * Gets data in collection, with args included
     * @param $key
     * @return bool
     */
    public function getCollection($key)
    {
        if (!isset($this->collection[$key]))
            return null;

        return $this->collection[$key];
    }

    /**
     * Triggers the processing of individual items from the collection
     * @param $key
     * @return $this
     */
    public function processCollection($key)
    {
        if (!isset($this->collection[$key]))
            return $this;

        $call = "processItem{$key}";

        foreach ($this->getCollection($key) as $item)
            $this->{$call}($item[0], $item[1]);

        return $this;
    }

    /**
     * Get the Attributes data from collection
     * @return array|bool
     */
    public function getAttributes()
    {
        $attributes = $this->getData('Attributes');
        if (isset($attributes[0])) $attributes = $attributes[0];
        if (!$attributes) $attributes = [];
        return $attributes;
    }

    /**
     * Handles dynamic add methods
     * This method is executed on any of the following calls:
     * ->addKey(string $data)
     * ->addKey(string $data, array $args)
     * ->addKey(string $data, string $data, array $args)
     * ->addKey(array $data, array $args)
     *
     * @param $arguments
     * @param $key
     * @return $this
     */
    public function handleDynamicAdd($key, $arguments)
    {
        // by default store everything we get as data and assume there are no args
        $data = $arguments;
        $args = [];

        // if we get an array, extract the data and args
        if (is_array($arguments) && isset($arguments[0]))
        {
            // if the first key is array, set it as data
            if (is_array($arguments[0]))
            {
                $data = $arguments[0];

                // if the 2nd key is also array, set it as args
                if (isset($arguments[1]))
                    $args = $arguments[1];
            }
            // if the 1st key was not an array, assume the last key is our args and all other keys are the data
            else
            {
                // if last key is an array, extract it as args and set the rest as data
                if (is_array(end($arguments)))
                {
                    $args = array_pop($arguments);
                    $data = $arguments;
                }
            }
        }
        $this->addCollectionItem($data, $args, $key);
        return $this;
    }

    /**
     * Handles dynamic state setters
     * e.g. executed when called ->isStateable(stating)
     * @param $stateable
     * @param bool $stating
     * @return $this
     */
    public function handleDynamicSetState($stateable, $stating = true)
    {
        $cast_boolean = ['true', 'false'];
        if (in_array($stating, $cast_boolean, true))
            foreach($cast_boolean as $boolean)
                if ($stating === $boolean)
                {
                    $stating = (boolean) $stating === $boolean;
                    break;
                }

        if ($this->lastCollectionKey)
            $this->updateLastCollectionArgs($stateable, $stating);
        else
            $this->addCollectionItem($stating, [], $stateable);

        return $this;
    }

    /**
     * Handles dynamic state getters
     * e.g. executed when called ->hasStateable(state)
     * @param $stateable
     * @param bool $state
     * @return bool
     */
    public function handleDynamicHasState($stateable, $state = true)
    {
        return $this->getData($stateable) === $state;
    }

    /**
     * Remove from collection item by key
     * @param $key
     * @param $remove
     */
    public function handleDynamicRemoveFromCollection($key, $remove)
    {
        $collection = $this->getData($key);

        if (isset($collection[$remove]))
            unset($collection[$remove]);

        if (isset($collection[0][$remove]))
            unset($collection[0][$remove]);

        $this->updateCollection($collection, [], $key);
    }

    /**
     * Get data from collection dynamically
     * e.g. executed when called ->getKey()
     * @param $key
     * @return bool
     */
    public function handleDynamicGetCollection($key)
    {
        return $this->getData($key);
    }

    /**
     * Merges existing data in a collection with new data
     * @param array $data
     * @param $key
     * @return array|bool
     */
    public function handleDynamicMergeCollection($key, array $data)
    {
        if (!is_array($data)) return false;
        if (empty($data)) return false;

        $collection = $this->getData($key);
        if (!$collection)
        {
            $this->addCollectionItem($data, [], $key);
            return $data;
        }

        // if we get a new id, remove the old one
        if (isset($collection[0]['id']) && isset($data[0]['id']))
            unset($collection[0]['id']);

        $newData = [];
        if (!is_array($collection[key($collection)])) $collection = [$collection];
        $data = array_merge_recursive($collection, $data);

        foreach($data as $item)
            $newData = array_merge_recursive($newData, $item);

        $this->updateCollection($newData, [], $key);
        return $newData;
    }

    /**
     * Returns a string with all the data from a collection concatenated
     * @param $key
     * @return string
     */
    public function handleDynamicStringifyCollection($key)
    {
        $data = [];
        $collection = $this->getCollection($key);

        if (!$collection) return "";

        foreach ($collection as $item) $data[] = $item[0][0];
        return implode("", $data);
    }

    /**
     * Set options for the item last added in a collection
     * @param $stateable
     * @param $stating
     */
    public function updateLastCollectionArgs($stateable, $stating)
    {
        $stateable = strtolower($stateable);
        $collection = $this->getCollection($this->lastCollectionKey);
        if ($collection)
        {
            $last = end($collection);
            $last[1] = array_merge($last[1], [$stateable => $stating]);

            array_pop($this->collection[$this->lastCollectionKey]);
            $this->addCollectionItem($last[0], $last[1], $this->lastCollectionKey);
        }
    }

    /**
     * Changes wrapping behaviour
     * @param $element
     * @param array $attributes
     * @return $this
     */
    public function wrap($element, $attributes = [])
    {
        $this->widgetWrap = true;
        $this->widgetTag = $element;
        $this->addAttributes($attributes);
        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function addClass($class)
    {
        $this->addAttributes(['class' => $class]);
        return $this;
    }

    /**
     * @return $this
     */
    public function pullLeft()
    {
        $this->addAttributes(['class' => 'pull-left']);
        return $this;
    }

    /**
     * @return $this
     */
    public function pullRight()
    {
        $this->addAttributes(['class' => 'pull-right']);
        return $this;
    }

    /**
     * Combine default widget attributes with
     * user defined widget attributes
     *
     * @param $args
     * @return $this
     */
    public function addAttributes(array $args)
    {
        if (!is_array($args))
            return $this;

        if (empty($args))
            return $this;

        $this->mergeAttributes($args);
        return $this;
    }

    /**
     * Setter for data binding
     * @param $callable
     * @param $args
     * @return $this
     */
    public function call($callable, $args)
    {
        $this->addAttributes([
            'call' => [
                $callable => $args
            ]
        ]);
        return $this;
    }

    /**
     * Shortcut for binding data to Widget attributes
     * @param $key
     * @param $value
     * @return $this
     */
    public function callAttributeDynamic($key, $value)
    {
        return $this->call('addAttributes', [$key => $value]);
    }

    /**
     * Process data-binding to widgets (e.g. Buttons, Checkbox)
     * @param WidgetCreatorAbstract $widget
     * @param array $data
     * @return mixed
     */
    public function bindWidget(WidgetCreatorAbstract $widget, array $data = [])
    {
        $widget = clone $widget;
        $mapping = $widget->getAttributes();
        $dataKeys = array_keys($data);
        if ($mapping && isset($mapping['call']) && is_array($mapping['call']))
        {
            foreach($mapping['call'] as $mappingAction => $mappingArgs)
            {
                foreach($dataKeys as $key)
                    if (isset($data[$key]) && !is_array($data[$key]) && !is_object($data[$key]))
                        $mappingArgs = str_replace("{" . $key . "}", $data[$key], $mappingArgs);

                if (is_array($mappingArgs))
                    foreach($mappingArgs as $mk => $mv)
                        if (is_string($mv) && stristr($mv, "=="))
                            $mappingArgs[$mk] = eval('return ' . $mv . ';');

                call_user_func_array(array($widget, $mappingAction), [$mappingArgs]);
            }
            $widget->removeAttributes('call');
        }
        $widget = $widget->__toString();
        return $widget;
    }

    /**
     * Process data-binding to non-widgets
     * @param string $value
     * @param array $data
     * @return mixed|string
     */
    public function bindData($value = '', array $data = [])
    {
        $dataKeys = array_keys($data);
        foreach($dataKeys as $key)
            if (isset($data[$key]) && !is_array($data[$key]) && !is_object($data[$key]))
                $value = str_replace("{" . $key . "}", $data[$key], $value);

        return $value;
    }

    /**
     * Appends to the widget content
     * @param string $content
     * @return $this
     */
    public function add($content = '')
    {
        $this->addContents($content);
        return $this;
    }

    /**
     * Returns the final widget
     * @return string
     */
    public function getWidget()
    {
        return $this->widgetWrap ?
            $this->createWrapper($this->widgetTag, $this->getAttributes(), $this->stringifyContents()) :
            $this->stringifyContents();
    }

    /**
     * Matches an array key exists and has a not empty value
     * and in strict mode it also matches the value against a type
     * @param $match
     * @param array $args
     * @param bool $matches
     * @param bool $strict
     * @return bool
     */
    public function attributeMatch($match, array $args = [], $matches = true, $strict = false)
    {
        return $strict === true ?
            isset($args[$match]) && $args[$match] === $matches :
            isset($args[$match]) && !empty($args[$match]);
    }

    /**
     * Adds a value to an array with dynamic key
     * only if the array has a key named like the value
     * and that key's value matches against a type
     * @param $key
     * @param $add
     * @param array $args
     * @param null $match
     * @param bool $matches
     * @param bool $force_add
     * @return array
     */
    public function attributeAddMatchDynamic($key, $add, array $args = [], $match = null, $matches = true, $force_add = false)
    {
        if (is_null($match)) $match = $add;

        if ($this->attributeMatch($match, $args, $matches) || $force_add === true)
        {
            $values = isset($args[$key]) ? $args[$key] : [];
            if (!is_array($values)) $values = array_reverse(explode(" ", $values));

            if (!in_array($add, $values))
                $values[] = $add;

            $attributes = [$key => implode(" ", $values)];
            $args = array_merge($args, $attributes);
        }

        return $args;
    }

    /**
     * Adds a value to an array with dynamic key
     * @param $key
     * @param $add
     * @param $args
     * @return array
     */
    public function attributeAddDynamic($key, $add, $args)
    {
        return $this->attributeAddMatchDynamic($key, $add, $args, null, null, true);
    }

    /**
     * Handle dynamic static method calls
     *
     * @param $name
     * @param $args
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        $args = empty($args) ? [] : $args[0];
        self::$instance = new static($name, $args);
        return self::$instance;
    }

    /**
     * Get a WidgetCreatorAbstract instance
     * @return mixed
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|array|bool
     */
    public function __call($name, $arguments)
    {
        // actionKeyParam(arguments) -> $action, $key, $param, $arguments
        $parts = preg_split('/(?=[A-Z])/', lcfirst($name));

        // the action
        $action = $parts[0];

        // to execute an action, a key must be provided
        if (!isset($parts[1]))
            return $this;

        // the key
        $key = $parts[1];

        // the param
        $param = false;
        if (isset($parts[2])) $param = $parts[2];

        if ($action == 'add')
            $this->lastCollectionKey = $key;

        // execute the action
        switch ($action)
        {
            default: break;
            case 'get': $call = "handleDynamicGetCollection"; break;
            case 'add': return $this->handleDynamicAdd($key, $arguments); break;
            case 'remove': $call = "handleDynamicRemoveFromCollection"; break;
            case 'call':
                $attributeParts = $parts;
                $key = strtolower(array_pop($attributeParts));
                $call = "callAttributeDynamic";
                break;
            case 'process': $call = "processCollection"; break;
            case 'merge': return $this->handleDynamicMergeCollection($key, $arguments); break;
            case 'stringify': $call = "handleDynamicStringifyCollection"; break;
            case 'attribute':
                $attributeParts = $parts;
                $key = strtolower(array_pop($attributeParts));
                $action = implode("", $attributeParts);
                $call = "{$action}Dynamic";
                break;
            case 'is': case 'set': $call = "handleDynamicSetState"; break;
            case 'has': $call = "handleDynamicHasState"; break;
        }

        array_unshift($arguments, $key);
        if ($call) return call_user_func_array(array($this, $call), $arguments);

        return $this;
    }

    /**
     * Outputs the markup
     * @return string
     */
    public function __toString()
    {
        $output = $this->getWidget();
        return $output;
    }
}