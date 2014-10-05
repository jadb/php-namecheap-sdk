<?php

namespace Namecheap\Test\Service;

use Mockery as m;
use Namecheap\Service\BasicServiceDescription;

class TestDescription extends BasicServiceDescription
{
    protected function getServiceDescription()
    {
        return [
            'operations' => [
                'testMethod' => [
                    'normalParam' => [
                        'type' => 'string',
                        'location' => 'uri'
                    ],
                    'stringParam'
                ]
            ]
        ];
    }
}

class BasicServiceDescriptionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructCorrectDescription()
    {
        $description = new TestDescription([
            'ApiUser' => 'user',
            'ApiKey' => 'key',
            'UserName' => 'username',
            'ClientIp' => 'clientip',
        ]);

        $operations = [
            'testMethod' => [
                'httpMethod' => 'GET',
                'uri' => '/xml.response',
                'documentationUrl' => 'https://www.namecheap.com/support/api/methods/test/test-method.aspx',
                'parameters' => [
                    'normalParam' => ['type' => 'string', 'location' => 'uri'],
                    'stringParam' => ['type' => 'string', 'location' => 'query'],
                    'ApiUser' => ['type' => 'string', 'location' => 'query'],
                    'ApiKey' => ['type' => 'string', 'location' => 'query'],
                    'UserName' => ['type' => 'string', 'location' => 'query'],
                    'ClientIp' => ['type' => 'string', 'location' => 'query'],
                    'Command' => ['default' => 'namecheap.test.testmethod', 'static' => true, 'type' => 'string', 'location' => 'query'],
                ],
                'responseModel' => 'simpleXmlResponse',
                'name' => 'testMethod'
            ]
        ];

        $this->assertInstanceOf('Namecheap\Service\BasicServiceDescription', $description);
        $this->assertEquals(BasicServiceDescription::NAME, $description->getName());
        $this->assertEquals(BasicServiceDescription::DESCRIPTION, $description->getDescription());
        $this->assertEquals(BasicServiceDescription::API_VERSION, $description->getApiVersion());
        $this->assertEquals(BasicServiceDescription::BASE_URL, $description->getBaseUrl());
        $this->assertEquals($operations, $description->getOperations());
        // var_dump($description->getParams());die();
    }
}
