<?php

namespace Namecheap\Test\Element\Text;

use Namecheap\Element\Text\ExecutionTime;
use Namecheap\Test\Element\ReaderTrait;

class ExecutionTimeTest extends \PHPUnit_Framework_TestCase
{

    use ReaderTrait;

    public function testDeserializeXmlAndReturnElementAsResultString()
    {
        $xml = '<ExecutionTime>0.002</ExecutionTime>';
        $reader = $this->getReader($xml);
        $result = ExecutionTime::deserializeXml($reader);
        $this->assertEquals('0.002', (string) $result);
    }

}
