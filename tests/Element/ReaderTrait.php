<?php

namespace Namecheap\Test\Element;

use Sabre\XML\Reader;

trait ReaderTrait
{

    public function getReader($xml)
    {
        $reader = new Reader();
        $reader->xml($xml);
        $reader->read();
        return $reader;
    }

}
