<?php

namespace Namecheap\Element\Collection;

use Namecheap\Element\AbstractElement;
use Namecheap\Element\Container\AbstractContainerElement;
use Namecheap\Element\Text\AbstractTextElement;
use Sabre\XML\Reader;

abstract class AbstractCollectionElement
extends AbstractElement
implements \Countable
{

    /**
     * Collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * @inheritdoc
     */
    protected function seed(Reader $reader)
    {
        foreach ((array) $reader->parseInnerTree() as $node) {
            $this->items[] = $node['value']->dump();
        }

        $reader->next();
    }

    /**
     * Returns items in collection.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function count($mode = COUNT_NORMAL)
    {
        return count($items);
    }

}
