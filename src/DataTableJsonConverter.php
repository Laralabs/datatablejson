<?php

namespace Laralabs\DataTableJson;

class DataTableJsonConverter
{
    /**
     * The namespace to put JS variable under
     * @var string
     */
    protected $namespace;

    /**
     * @var DataTableJsonViewBinder
     */
    protected $viewBinder;

    function __construct(DataTableJsonViewBinder $viewBinder, $namespace = 'window')
    {
        $this->viewBinder = $viewBinder;
        $this->namespace = $namespace;
    }

    /**
     * Encode data to JSON and bind to the view
     *
     * @param array $data
     * @return string
     */
    public function put(array $data = [])
    {
        reset($data);
        $js = 'window.'.$this->namespace.' = window.'.$this->namespace.' || {};'.$this->namespace.'.'.key($data).' = ';
        $js = $js.json_encode($data[key($data)]);

        $this->viewBinder->bind($js);

        return $js;
    }
}