<?php

namespace Namecheap\Test\Element\Text;

use Namecheap\Test\Element\ReaderTrait;
use Namecheap\Test\Element\Sample\FooText;

class AbstractTextElementTest extends \PHPUnit_Framework_TestCase
{

    use ReaderTrait;

    public function testDeserializeXmlAndReturnElementAsResultString()
    {
        $xml = '<Foo>bar</Foo>';
        $reader = $this->getReader($xml);
        $result = FooText::deserializeXml($reader);
        $this->assertEquals('bar', (string) $result);
    }

}
