<?php

namespace Namecheap;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Namecheap\Service\ResponseLocation\XmlLocation;

class Client
{
    /**
     * @var string
     */
    protected $apiUser;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $clientIp;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var array
     */
    protected $services = [];

    /**
     * @var string
     */
    protected $userName;

    /**
     * @var boolean
     */
    protected $useSandbox;

    /**
     * Constructor
     *
     * @param string $apiUser
     * @param string $apiKey
     * @param string $userName
     * @param string $clientIp
     * @param boolean $useSandbox
     * @param \GuzzleHttp\Client $guzzleClient
     * @return void
     */
    public function __construct(
        $apiUser,
        $apiKey,
        $userName,
        $clientIp,
        $useSandbox = false,
        GuzzleHttpClient $guzzleClient = null
    )
    {
        $this->apiUser      = $apiUser;
        $this->apiKey       = $apiKey;
        $this->userName     = $userName;
        $this->clientIp     = $clientIp;
        $this->useSandbox   = $useSandbox;
        $this->guzzleClient = $guzzleClient ?: new GuzzleHttpClient();
    }

    public function __call($name, $args)
    {
        $classname = '\Namecheap\Service\\' . ucfirst($name) . 'Description';

        if (empty($this->services[$name])) {
            $this->services[$name] = new $classname([], ['test' => $this->useSandbox]);
        }

        return new GuzzleClient($this->guzzleClient, $this->services[$name], [
            'defaults' => [
                'ApiUser'  => $this->apiUser,
                'ApiKey'   => $this->apiKey,
                'UserName' => $this->userName,
                'ClientIp' => $this->clientIp,
            ],
            'response_locations' => ['xml' => new XmlLocation('xml')]
        ]);
    }

}
