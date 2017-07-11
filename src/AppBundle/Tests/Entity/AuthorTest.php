<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Author;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function testAdd()
    {
        $obj = new Author();
        $obj->setName('test');

        $this->assertEquals('test', $obj->getName());
    }
}
