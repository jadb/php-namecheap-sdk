<?php

namespace Namecheap\Element\Container;

use Sabre\XML\Reader;

class Tld extends AbstractContainerElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

}
