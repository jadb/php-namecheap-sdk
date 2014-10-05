<?php

namespace Namecheap\Element\Container;

use Cake\Utility\Inflector;
use Sabre\XML\Reader;

class ApiResponse extends AbstractContainerElement
{

    /**
     * @{inheritdoc}
     */
    static public function deserializeXml(Reader $reader)
    {
        $element = new self();

        // Extract response status from node attributes
        $status = $reader->parseAttributes();
        $element->container['status'] = $status['Status'];

        // Loop through nodes, dumping every element into container
        foreach ((array) $reader->parseInnerTree() as $node) {
            $key = Inflector::underscore($node['value']->getName());
            $element->container[$key] = $node['value']->dump();
        }

        $reader->next();
        return $element;
    }

}
