<?php

namespace Namecheap\Element;

use Cake\Utility\Inflector;
use Sabre\XML\Element;
use Sabre\XML\Reader;
use Sabre\XML\Writer;

abstract class AbstractElement implements Element
{

    /**
     * Read-only elements - no need for writing.
     */
    final public function serializeXml(Writer $writer) {}

    /**
     * Returns element's name to use as key in the result's
     * associative array.
     *
     * @return string
     */
    public function getName()
    {
        $class = explode('\\', get_class($this));
        return Inflector::underscore(array_pop($class));
    }

    /**
     * Dump element into an array or string depending on it's type.
     *
     * @return array|string
     */
    public function dump()
    {
        if (is_a($this, '\\Namecheap\\Element\\Text\\AbstractTextElement')) {
            return (string) $this;
        }

        return $this->toArray();
    }

}
