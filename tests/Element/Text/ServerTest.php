<?php

namespace Namecheap\Test\Element\Text;

use Namecheap\Element\Text\Server;
use Namecheap\Test\Element\ReaderTrait;

class ServerTest extends \PHPUnit_Framework_TestCase
{

    use ReaderTrait;

    public function testDeserializeXmlAndReturnElementAsResultString()
    {
        $xml = '<Server>WEB1-SANDBOX1</Server>';
        $reader = $this->getReader($xml);
        $result = Server::deserializeXml($reader);
        $this->assertEquals('WEB1-SANDBOX1', (string) $result);
    }

}
