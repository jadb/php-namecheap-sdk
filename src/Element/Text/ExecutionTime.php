<?php

namespace Namecheap\Element\Text;

use Sabre\XML\Reader;

class ExecutionTime extends AbstractTextElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

}
