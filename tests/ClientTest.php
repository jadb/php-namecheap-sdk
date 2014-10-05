<?php

namespace Namecheap\Test;

use Mockery as m;
use Namecheap\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testMagicCall()
    {
        $nc = new Client('user', 'key', 'username', 'ip', true);
    }

}
