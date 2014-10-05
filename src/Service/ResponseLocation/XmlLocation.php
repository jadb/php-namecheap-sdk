<?php

namespace Namecheap\Service\ResponseLocation;

use GuzzleHttp\Command\Guzzle\GuzzleCommandInterface;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Command\Guzzle\ResponseLocation\AbstractLocation;
use GuzzleHttp\Message\ResponseInterface;
use Sabre\XML;

class XmlLocation extends AbstractLocation
{
    const NS = 'http://api.namecheap.com/xml.response';

    protected $xmlElements = [
        'Text\ExecutionTime',
        'Text\GMTTimeDifference',
        'Text\RequestedCommand',
        'Text\Server',

        'Container\ApiResponse',
        'Container\DomainCheckResult',
        'Container\Error',
        'Container\Tld',
        'Container\Warning',

        'Collection\CommandResponse',
        'Collection\Errors',
        'Collection\Tlds',
        'Collection\Warnings',
    ];

    private $response;

    protected function xmlElementMap()
    {
        $map = [];
        foreach ($this->xmlElements as $class) {
            list(, $element) = explode('\\', $class);
            $map['{' . self::NS . '}' . $element] = '\\Namecheap\\Element\\' . $class;
        }
        return $map;
    }

    public function before(
        GuzzleCommandInterface $command,
        ResponseInterface $response,
        Parameter $model,
        &$result,
        array $context = []
    )
    {
        $reader = new XML\Reader();
        $reader->xml($response->getBody());
        $reader->elementMap = $this->xmlElementMap();
        $this->response = $reader->parse();
    }

    public function after(
        GuzzleCommandInterface $command,
        ResponseInterface $response,
        Parameter $model,
        &$result,
        array $context = []
    )
    {
        $result = $this->response['value']->dump();
    }

    private function parse($response)
    {
        $result = [];
        print_r($response);die();
        $result['status'] = $response['attributes']['Status'];

        foreach ($response['value'] as $k => $node) {
            $key = Inflector::underscore($node->getName());

        }
        // $children = (array) $this->xml->children(null, true);
print_r($this->response);die();

        // Status
        $status = (array) $this->xml->attributes(null, true);
        $result['status'] = current(current($status));

        // Errors
        if ('OK' != $result['status']) {
            $errors = (array) $children['Errors'];
            $result['error'] = array_pop($errors);
            return $result;
        }

        // Results
        $commandResponse = (array) $children['CommandResponse'];
        $result['result'] = $this->parseXmlCommandResponse((array) array_pop($commandResponse));

        // TODO Warnings, GMTTimeDifference, ExecutionTime

        $this->xml = null;
        return $result;
    }

    protected function parseXmlCommandResponse($commandResponse)
    {
        $result = [];
print_r($commandResponse);die();

        $keys = array_filter(array_keys($commandResponse), 'is_numeric');
        // Parse multi-result response
        if (count($keys) == count($commandResponse)) {
            foreach ($commandResponse as $xml) {
                $attributes = (array) $xml->attributes(null, true);
                $result[] = array_pop($attributes);
            }
            return $result;
        }

        // TODO Parse single result response
        throw new \Exception('Not implemented yet.');
    }
}
