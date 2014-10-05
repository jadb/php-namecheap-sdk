<?php

namespace Namecheap\Test\Element\Text;

use Namecheap\Element\Text\RequestedCommand;
use Namecheap\Test\Element\ReaderTrait;

class RequestedCommandTest extends \PHPUnit_Framework_TestCase
{

    use ReaderTrait;

    public function testDeserializeXmlAndReturnElementAsResultString()
    {
        $xml = '<RequestedCommand>namecheap.domains.check</RequestedCommand>';
        $reader = $this->getReader($xml);
        $result = RequestedCommand::deserializeXml($reader);
        $this->assertEquals('namecheap.domains.check', (string) $result);
    }

}
