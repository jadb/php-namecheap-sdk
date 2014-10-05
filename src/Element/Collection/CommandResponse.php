<?php

namespace Namecheap\Element\Collection;

use Sabre\XML\Reader;

class CommandResponse extends AbstractCollectionElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

    public function getName()
    {
        return 'Body';
    }

    public function dump()
    {
        $dump = parent::dump();
        if (count($dump) === 1) {
            $dump = array_pop($dump);
        }
        return $dump;
    }

}
