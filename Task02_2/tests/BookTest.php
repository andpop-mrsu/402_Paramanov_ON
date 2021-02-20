<?php

namespace Tests\BookTest;

use App\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testSetName()
    {
        $book = new Book();
        $book->setName("Сollection of fairy tales");

        $this->assertEquals("Сollection of fairy tales", $book->getName());
    }

    public function testSetAuthors()
    {
        $book = new Book();
        $book->setAuthors(array("A. Pushkin", "L. Tolstoy"));

        $this->assertEquals(array("A. Pushkin", "L. Tolstoy"), $book->getAuthors());
    }

    public function testSetPublisher()
    {
        $book = new Book();
        $book->setPublisher("AST");

        $this->assertEquals("AST", $book->getPublisher());
    }

    public function testSetYear()
    {
        $book = new Book();
        $book->setYear(2005);

        $this->assertEquals(2005, $book->getYear());
    }
}
