<?php

namespace Namecheap\Element\Container;

use Namecheap\Element\AbstractElement;
use Sabre\XML\Reader;

abstract class AbstractContainerElement extends AbstractElement
{

    protected $container = [];

    protected function seed(Reader $reader)
    {
        $this->container = $reader->parseAttributes();
        $reader->next();
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }
    
    public function toArray()
    {
        return $this->container;
    }

}
