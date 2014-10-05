<?php

namespace Namecheap\Element\Container;

use Sabre\XML\Reader;

class Error extends AbstractContainerElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

    protected function seed(Reader $reader)
    {
        $number = $reader->parseAttributes();
        $description = $reader->parseInnerTree();

        $this->container = ['description' => $description, 'number' => $number['Number']];

        $reader->next();
    }

}
