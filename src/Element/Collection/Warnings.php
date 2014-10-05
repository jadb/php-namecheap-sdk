<?php

namespace Namecheap\Element\Collection;

use Sabre\XML\Reader;

class Warnings extends AbstractCollectionElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

}
