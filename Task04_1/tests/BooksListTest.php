<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\BooksList;
use App\Book;

class BooksListTest extends TestCase
{
    public function testAddAndCount()
    {
        $book = new Book();
        $booksList = new BooksList();
        $booksList->add($book);
        $this->assertSame(1, $booksList->count());
    }

    public function testGet()
    {
        $book = new Book();
        $booksList = new BooksList();
        $book->setName("Сollection of fairy tales")->setAuthors(array("A. Pushkin", "L. Tolstoy"))
            ->setPublisher("AST")->setYear(2005);
        $booksList->add($book);
        $this -> assertInstanceOf(Book::class, $booksList -> get(1));
    }

    public function testStore()
    {
        $book = new Book();
        $booksList = new BooksList();
        $book->setName("Сollection of fairy tales")->setAuthors(array("A. Pushkin", "L. Tolstoy"))
            ->setPublisher("AST")->setYear(2005);
        $booksList->add($book);
        $this -> assertSame(null, $booksList -> store("output"));
    }

    public function testLoad()
    {
        $booksList = new BooksList();
        $booksList->load("output");
        $this->assertSame(1, $booksList->count());
        $this->assertInstanceOf(Book::class, $booksList->get(1));
    }

    public function testCurrentAndKey()
    {
        $book1 = new Book();
        $book2 = new Book();
        $book3 = new Book();
        $booksList = new BooksList();
        $book1 -> setName("Сollection of fairy tales")->setAuthors(array("A. Pushkin", "L. Tolstoy"))
            ->setPublisher("AST")->setYear(2005);
        $book2 -> setName("Collection")->setAuthors(array("A.B. Games"))
            ->setPublisher("Weird Tales")->setYear(1926);
        $book3 -> setName("Princes")
            ->setAuthors(array("A.Make", "G.Moner", "L.Niolit"))
            ->setPublisher("University")->setYear(2008);
        $booksList -> add($book1);
        $booksList -> add($book2);
        $booksList -> add($book3);

        $this->assertSame(
            "Id: 4" . "\n" .
            "Название: Сollection of fairy tales" . "\n" .
            "Автор 1: A. Pushkin" . "\n" .
            "Автор 2: L. Tolstoy" . "\n" .
            "Издательство: AST" . "\n" .
            "Год: 2005",
            $booksList -> current() -> __toString()
        );
        $this -> assertSame(4, $booksList -> key());
        return $booksList;
    }

    public function testNext(BooksList $booksList)
    {
        $booksList->next();
        $this->assertSame(
            "Id: 5" . "\n" .
            "Название: Collection" . "\n" .
            "Автор 1: A.B. Games" . "\n" .
            "Издательство: Weird Tales" . "\n" .
            "Год: 1926",
            $booksList -> current() -> __toString()
        );
        $booksList->next();
        $this->assertSame(
            "Id: 6" . "\n" .
            "Название: Princes" . "\n" .
            "Автор 1: A.Make" . "\n" .
            "Автор 2: G.Moner" . "\n" .
            "Автор 3: I. L.Niolit" . "\n" .
            "Издательство: University" . "\n" .
            "Год: 2008",
            $booksList -> current() -> __toString()
        );

        return $booksList;
    }

    public function testValidAndRewind(BooksList $booksList)
    {
        $booksList -> next();
        $this -> assertSame(false, $booksList -> valid());
        $booksList -> rewind();
        $this -> assertSame(true, $booksList -> valid());
        $this -> assertSame(
            "Id: 4" . "\n" .
            "Название: Сollection of fairy tales" . "\n" .
            "Автор 1: A. Pushkin" . "\n" .
            "Автор 2: L. Tolstoy" . "\n" .
            "Издательство: AST" . "\n" .
            "Год: 2005",
            $booksList->current()->__toString()
        );
    }
}
