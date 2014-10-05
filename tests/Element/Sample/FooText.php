<?php

namespace Namecheap\Test\Element\Sample;

use Namecheap\Element\Text\AbstractTextElement;
use Sabre\XML\Reader;

class FooText extends AbstractTextElement
{

    static public function deserializeXml(Reader $reader)
    {
        $element = new self();
        $element->seed($reader);
        return $element;
    }

}
