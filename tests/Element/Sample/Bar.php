<?php

namespace Namecheap\Test\Element\Sample;

use Namecheap\Element\AbstractElement;
use Sabre\XML\Reader;

class Bar extends AbstractElement
{

    static public function deserializeXml(Reader $reader)
    {
    }

    public function getName()
    {
        return 'custom_bar';
    }

}
