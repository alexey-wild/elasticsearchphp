<?php

namespace Elasticsearchphp;

use Elasticsearchphp\Cluster\Cluster;
use Elasticsearchphp\Events\Events;
use Elasticsearchphp\Requests;
use Elasticsearchphp\Exceptions;
use Elasticsearchphp\Wrappers;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Primary object through which the ElasticSearch cluster is accessed.
 *
 * <code>
 * require 'vendor/autoload.php';
 * $elasticsearchphp = new Elasticsearchphp();
 * </code>
 */
class Elasticsearchphp
{
    /**
     * @var array Elasticsearchphp settings, can be replaced with user-settings through constructor
     */
    protected $settings;

    /**
     * Elasticsearchphp constructor, accepts optional user settings
     * @param array $userSettings Optional user settings to over-ride the default
     */
    public function __construct($userSettings = array())
    {
        $this->settings = array_merge(static::getDefaultSettings(), $userSettings);

        //Build a cluster and inject our dispatcher
        $this->settings['cluster'] = new Cluster($this->settings['event.dispatcher']);

        //Connect Cluster's listener to the dispatcher
        $eventCallback = array($this->settings['cluster'], 'onRequestExecute');
        $this->settings['event.dispatcher']->addListener(Events::REQUEST_PREEXECUTE, $eventCallback);

        $this->autodetect();
    }

    /********************************************************************************
     * PSR-0 Autoloader
     *
     * Do not use if you are using Composer to autoload dependencies.
     *******************************************************************************/

    /**
     * Elasticsearchphp PSR-0 autoloader
     */
    public static function autoload($className)
    {
        $thisClass = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        $baseDir = __DIR__;

        if (substr($baseDir, -strlen($thisClass)) === $thisClass) {
            $baseDir = substr($baseDir, 0, -strlen($thisClass));
        }

        $className = ltrim($className, '\\');
        $fileName  = $baseDir;
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($fileName)) {
            require $fileName;
        }
    }

    /**
     * Register Elasticsearchphp's PSR-0 autoloader
     */
    public static function registerAutoloader()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Elasticsearchphp::autoload");
    }

    /**
     * @return array Default settings
     */
    private static function getDefaultSettings()
    {
        return array(
            'base' => __DIR__.'/',
            'event.dispatcher' => new EventDispatcher(),
            'cluster' => null,
            'cluster.autodetect' => false,
            );
    }

    /**
     * Query builder, used to return a QueryWrapper through which a Query component can be selected
     * @return \Elasticsearchphp\Wrappers\QueryWrapper
     */
    public static function queryBuilder()
    {
        return new \Elasticsearchphp\Wrappers\QueryWrapper();
    }

    /**
     * Filter builder, used to return a FilterWrapper through which a Filter component can be selected
     * @return \Elasticsearchphp\Wrappers\FilterWrapper
     */
    public static function filterBuilder()
    {
        return new \Elasticsearchphp\Wrappers\FilterWrapper();
    }

    /**
     * @return \Elasticsearchphp\Wrappers\SortWrapper
     */
    public static function sortBuilder()
    {
        return new \Elasticsearchphp\Wrappers\SortWrapper();
    }


    /**
     * Index builder, used to return a IndexWrapper through which an Index component can be selected
     * @return \Elasticsearchphp\Wrappers\IndexSettingsWrapper
     */
    public static function indexSettingsBuilder()
    {
        return new \Elasticsearchphp\Wrappers\IndexSettingsWrapper();
    }


    /**
     * Mapping builder, used to return a MappingWrapper through which a Mapping component can be selected
     * @param  null|string                     $type
     * @return \Elasticsearchphp\Wrappers\MappingPropertyWrapper
     */
    public static function mappingBuilder($type = null)
    {
        return new \Elasticsearchphp\Wrappers\MappingPropertyWrapper($type);
    }

    /**
     * Used to obtain a SearchRequest object, allows querying the cluster with searches
     * @return \Elasticsearchphp\Requests\SearchRequest
     */
    public function search()
    {
        return new \Elasticsearchphp\Requests\SearchRequest($this->settings['event.dispatcher']);
    }

    /**
     * Used to return an IndexDocumentRequest object, allows adding a doc to the index
     * @return \Elasticsearchphp\IndexDocumentRequest
     */
    public function document()
    {
        return new \Elasticsearchphp\Requests\IndexDocumentRequest($this->settings['event.dispatcher']);
    }

    /**
     * Used to return a DeleteDocumentRequest object, allows deleting a doc from the index
     * @return \Elasticsearchphp\Requests\DeleteDocumentRequest
     */
    public function deleteDocument()
    {
        return new \Elasticsearchphp\Requests\DeleteDocumentRequest($this->settings['event.dispatcher']);
    }


    /**
     * Used to return a GetDocumentRequest object, allows retrieving a doc by id
     * @return \Elasticsearchphp\Requests\GetDocumentRequest
     */
    public function getDocument()
    {
        return new \Elasticsearchphp\Requests\GetDocumentRequest($this->settings['event.dispatcher']);
    }


    /**
     * @param  string                $index     Index to operate on
     * @param  string                $index,... Index to operate on
     * @return \Elasticsearchphp\Requests\IndexRequest
     */
    public function index($index = null)
    {
        $args = func_get_args();

        $index = array();

        foreach ($args as $arg) $index[] = $arg;

        return new \Elasticsearchphp\Requests\IndexRequest($this->settings['event.dispatcher'], $index);
    }

    /**
     * Autodetects various properties of the cluster and indices
     */
    public function autodetect()
    {
        //If we have nodes and are supposed to detect cluster settings/configuration
        if ($this->settings['cluster.autodetect'] == true) $this->settings['cluster']->autodetect();
    }

    /**
     * Add a new node to the ES cluster
     * @param  string                                     $host server host address, either IP or domain (defaults to localhost)
     * @param  int                                        $port ElasticSearch port (defaults to 9200)
     * @return \Elasticsearchphp\Elasticsearchphp
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     * @throws \Elasticsearchphp\Exceptions\InvalidArgumentException
     */
    public function addNode($host = 'localhost', $port = 9200)
    {
        $this->settings['cluster']->addNode($host, $port, $this->settings['cluster.autodetect']);

        return $this;
    }

    /**
     * @return array
     */
    public function getElasticsearchphpSettings()
    {
        return $this->settings;
    }

    private function initializeEventDispatcher()
    {
        $eventCallback = array($this->settings['cluster'], 'onRequestExecute');
        $this->settings['event.dispatcher']->addListener(Events::REQUEST_PREEXECUTE, $eventCallback);
    }

}
