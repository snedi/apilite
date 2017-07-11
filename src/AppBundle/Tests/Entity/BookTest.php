<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testAdd()
    {
        $obj = new Book();
        $obj->setAuthorId(1);
        $obj->setName('test');
        $obj->setDescription('desc');

        $this->assertEquals(1, $obj->getAuthorId());
        $this->assertEquals('test', $obj->getName());
        $this->assertEquals('desc', $obj->getDescription());
    }
}
