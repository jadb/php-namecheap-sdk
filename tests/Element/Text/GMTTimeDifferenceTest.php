<?php

namespace Namecheap\Test\Element\Text;

use Namecheap\Element\Text\GMTTimeDifference;
use Namecheap\Test\Element\ReaderTrait;

class GMTTimeDifferenceTest extends \PHPUnit_Framework_TestCase
{

    use ReaderTrait;

    public function testDeserializeXmlAndReturnElementAsResultString()
    {
        $xml = '<GMTTimeDifference>--4:00</GMTTimeDifference>';
        $reader = $this->getReader($xml);
        $result = GMTTimeDifference::deserializeXml($reader);
        $this->assertEquals('--4:00', (string) $result);
    }

}
