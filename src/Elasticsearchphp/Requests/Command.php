<?php

namespace Elasticsearchphp\Requests;

/**
 * @method \Elasticsearchphp\Requests\Command action() action(\string $value)
 * @method \Elasticsearchphp\Requests\Command id() id(\string $value)
 * @method \Elasticsearchphp\Requests\Command index() index(\string $value)
 * @method \Elasticsearchphp\Requests\Command type() type(\string $value)
 * @method \Elasticsearchphp\Requests\Command suffix() suffix(\string $value)
 */
class Command implements CommandInterface
{

    private $params;

    /**
     * @param array $hashMap Optional hashmap parameter, accepts an associative array to set parameters manually
     */
    public function __construct($hashMap = null)
    {
            //merge the provided values with our param array, overwriting defaults where necessary
        if (is_array(($hashMap)) && count($hashMap) > 0) $this->params = array_merge($this->params, $hashMap);

        $this->params['index'] = null;
        $this->params['action'] = null;
        $this->params['id'] = null;
        $this->params['type'] = null;
        $this->params['data'] = null;
        $this->params['suffix'] = null;

    }

    /**
     * @param $name
     * @param $args
     * @return \Elasticsearchphp\Requests\Command
     */
    public function __call($name, $args)
    {
        $this->params[$name] = $args[0];

        return $this;
    }

    /**
     * @param string|array $data
     */
    public function data($data)
    {
        if (is_string($data)) $this->params['data'] = json_decode($data);
        elseif (is_array($data)) $this->params['data'] = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        $uri = '/'.$this->params['index'];

        foreach (array('type', 'id', 'suffix') as $item) {
            if (isset($this->params[$item]) && $this->params[$item] !== null && $this->params[$item] != '') $uri .= '/' .$this->params[$item];
        }

        return $uri;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->params['action'];
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->params['data'];
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->params['index'];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->params['type'];
    }

}
