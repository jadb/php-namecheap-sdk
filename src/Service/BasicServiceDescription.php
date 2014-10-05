<?php

namespace Namecheap\Service;

use Cake\Utility\Inflector;
use GuzzleHttp\Command\Guzzle\Description;

abstract class BasicServiceDescription extends Description
{
    const BASE_URL = 'https://api.namecheap.com/';
    const BASE_URL_SANDBOX = 'https://api.sandbox.namecheap.com/';
    const DOCUMENTATION_URL = 'https://www.namecheap.com/support/api/methods/';
    const NAME = 'Namecheap API';
    const DESCRIPTION = '';
    const API_VERSION = '1.0';

    private $useSandbox = false;

    public function __construct(array $config, array $options = [])
    {
        $options = $this->normalizeOptions($options);
        $config = $this->normalizeConfig($config);
        parent::__construct($config, $options);
    }

    public function getServiceName()
    {
        $name = explode('\\', get_class($this));
        return strtolower(str_replace('Description', '', array_pop($name)));
    }

    protected function normalizeConfig($config)
    {
        $serviceDescription = $this->getServiceDescription() + ['operations' => [], 'models' => []];

        $additionalParameters = $config;
        $baseUrl = $this->useSandbox ? self::BASE_URL_SANDBOX : self::BASE_URL;
        $operations = $this->normalizeOperations($serviceDescription['operations'], $config);
        $models = $this->normalizeModels($serviceDescription['models']);
        $name = self::NAME;
        $description = self::DESCRIPTION;
        $apiVersion = self::API_VERSION;

        return compact('baseUrl', 'operations', 'models', 'apiVersion')
            + $serviceDescription
            + compact('name', 'description');
    }

    protected function normalizeModels($models)
    {
        if (empty($models)) {
            $models = ['simpleXmlResponse'];
        }

        foreach ($models as $k => $model) {
            if (is_numeric($k)) {
                unset($models[$k]);
                $k = $model;
                $models[$k] = ['additionalProperties' => []];
            }

            // Default to XML
            $models[$k]['additionalProperties'] += ['location' => 'xml'];

            // Default to object type
            $models[$k] += ['type' => 'object'];
        }

        return $models;
    }

    protected function normalizeOperations($operations, $additionalParameters)
    {
        $serviceName = $this->getServiceName();

        foreach ($operations as $k => $operation) {
            // Support services that pass operations with only parameters
            if (!isset($operation['parameters'])) {
                $operation = ['parameters' => $operation];
            }

            // Inject global parameters (i.e. ApiUser, ApiKey, etc.)
            array_push($operation['parameters'], 'ApiUser', 'ApiKey', 'UserName', 'ClientIp');
            $operation['parameters'] += ['Command' => [
                'default' => 'namecheap.' . $serviceName . '.' . strtolower($k),
                'static' => true
            ]];

            // Normalize parameters
            $operation['parameters'] = $this->normalizeParameters($operation['parameters']);

            // Inject global configuration
            $operations[$k] = [
                'httpMethod' => 'GET',
                'uri' => '/xml.response',
                'documentationUrl' => self::DOCUMENTATION_URL . $serviceName . '/' . Inflector::dasherize($k) . '.aspx',
            ]+ $operation;

            // Add a response model if none is passed
            $operations[$k] += ['responseModel' => 'simpleXmlResponse', 'name' => $k];
        }

        return $operations;
    }

    protected function normalizeOptions($options)
    {
        $options += [
            // 'formatter' => '\Namecheap\SchemaFormatter',
            'test' => false
        ];

        if ($options['test']) {
            $this->useSandbox = true;
        }

        unset($options['test']);
        return $options;
    }

    protected function normalizeParameters(array $parameters)
    {
        foreach ($parameters as $parameter => $options) {
            if (is_numeric($parameter)) {
                unset($parameters[$parameter]);
                $parameter = $options;
                $parameters[$parameter] = [];
            } else if (is_string($options)) {
                $parameters[$parameter] = [
                    'description' => $options
                ];
            }
            $parameters[$parameter] += ['type' => 'string', 'location' => 'query'];
        }

        return $parameters;
    }

    abstract protected function getServiceDescription();
}
