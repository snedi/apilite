<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testAdd()
    {
        $obj = new Auth();
        $result = $obj->setToken('sdfsdf465456');

        $this->assertEquals('sdfsdf465456', $obj->getToken());
    }
}
