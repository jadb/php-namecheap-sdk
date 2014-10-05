<?php

namespace Namecheap\Element\Text;

use Namecheap\Element\AbstractElement;
use Sabre\XML\Reader;

// Element that has no attributes and only a string as value.
abstract class AbstractTextElement extends AbstractElement
{

	private $value;

	protected function seed(Reader $reader)
	{
		$this->value = $reader->parseInnerTree();
		$reader->next();
	}

	public function __toString()
	{
		return $this->value;
	}

}
