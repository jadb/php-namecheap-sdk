<?php

namespace Namecheap\Element\Container;

use Sabre\XML\Reader;

class Warning extends Error
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

}
