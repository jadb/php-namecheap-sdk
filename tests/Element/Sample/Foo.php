<?php

namespace Namecheap\Test\Element\Sample;

use Namecheap\Element\AbstractElement;
use Sabre\XML\Reader;

class Foo extends AbstractElement
{

    static public function deserializeXml(Reader $reader)
    {
    }
}
