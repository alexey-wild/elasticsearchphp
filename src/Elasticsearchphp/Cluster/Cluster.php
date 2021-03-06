<?php

namespace Elasticsearchphp\Cluster;

/**
 * Class Cluster - provides functionality to deal with cluster state
 * @package Elasticsearchphp\Cluster
 */
use Guzzle\Http\Client;
use Elasticsearchphp\Events\RequestEvent;
use Elasticsearchphp\RuntimeException;

class Cluster
{
    private $nodes = array();

    /**
     * @param  string                              $host
     * @param  int                                 $port
     * @param  bool                                $autodetect
     * @throws Elasticsearchphp\Exceptions\BadResponseException
     * @throws Elasticsearchphp\Exceptions\InvalidArgumentException
     */
    public function addNode($host, $port, $autodetect = true)
    {
        if (!isset($host)) throw new Exceptions\BadResponseException("A server address must be provided when adding a node.");
        if(!is_numeric($port)) throw new Exceptions\InvalidArgumentException("Port argument must be a number");

        $this->nodes[$host] = array('host' => $host, 'port' => $port);
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Autodect various cluster properties
     */
    public function autodetect()
    {
        $this->autodetect_nodes();
    }

    /**
     * Triggered just prior to a request being executed
     * Inject a random node into the Request object
     * @param  RequestEvent                $event
     * @throws exceptions\RuntimeException
     */
    public function onRequestExecute(RequestEvent $event)
    {
        $request = $event->getRequest();

        //Make sure we have some nodes to choose from
        if (count($this->nodes) === 0) throw new RuntimeException("No nodes in cluster, request failed");

        //Choose a random node
        $request->node = $this->nodes[array_rand($this->nodes)];
    }

    /**
     * Autodetect the nodes in this cluster through Cluster State API
     */
    private function autodetect_nodes()
    {
        foreach ($this->nodes as $node) {

            try {
                $client = new Client('http://'.$node['host'].':'.$node['port']);
                $request = $client->get('/_nodes/http');
                $response = $request->send()->json();

                foreach ($response['nodes'] as $newNode) {

                    //we don't want http-inaccessible nodes
                    if (!isset($newNode['http_address']))
                        continue;

                    preg_match('/inet\[\/([0-9\.]+):([0-9]+)\]/i', $newNode['http_address'], $match);

                    $tNode = array('host' => $match[1], 'port' => $match[2]);

                    //use host as key so that we don't add duplicates
                    $this->nodes[$match[1]] = $tNode;
                }

                //we have the complete node list, no need to keep checking
                break;

            } catch (\Guzzle\Http\Exception\BadResponseException $e) {
                //error with this node, continue onto the next one
            }
        }
    }
}
