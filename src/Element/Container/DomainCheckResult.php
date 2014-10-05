<?php

namespace Namecheap\Element\Container;

use Sabre\XML\Reader;

class DomainCheckResult extends AbstractContainerElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $attributes = $reader->parseAttributes();
        $element->setContainer([$attributes['Domain'] => $attributes['Available']]);
        $reader->next();
        return $element;
    }

}
