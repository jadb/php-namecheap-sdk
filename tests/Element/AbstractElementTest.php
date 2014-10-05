<?php

namespace Namecheap\Test\Element;

use Namecheap\Element\AbstractElement;

class AbstractElementTest extends \PHPUnit_Framework_TestCase
{

    public function testGetName()
    {
        $element = new Sample\Foo();
        $this->assertEquals('foo', $element->getName());

        $element = new Sample\Bar();
        $this->assertEquals('custom_bar', $element->getName());

        $element = new Sample\FooBar();
        $this->assertEquals('foo_bar', $element->getName());
    }


}
