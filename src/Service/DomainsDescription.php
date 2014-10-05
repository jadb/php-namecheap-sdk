<?php

namespace Namecheap\Service;

class DomainsDescription extends BasicServiceDescription
{

    protected function getServiceDescription()
    {
        return [
            'operations' => [
                'getTldList' => [
                    'summary' => 'Returns a list of TLDs',
                    'parameters' => []
                ],
                'check' => [
                    'summary' => 'Checks the availability of domains',
                    'parameters' => [
                        'DomainList' => 'Comma-separated list of domains to check'
                    ],
                ],
                'getInfo' => [
                    'summary' => 'Returns information about the requested domain',
                    'parameters' => [
                        'DomainName' => [
                            'description' => 'Domain name to get information about',
                            'maxLength' => 70
                        ],
                    ]
                ]
            ]
        ];
    }

}
