<?php
class Library
{
    public string $name;

    private array $books = [];
    private array $readers = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addBook(Book $book): void
    {
        if (!$book instanceof Book) {
            return;
        }
        array_push($this->books, $book);
    }

    public function registerReader(Reader $reader): void
    {
        if (!$reader instanceof Reader) {
            return;
        }
        array_push($this->readers, $reader);
    }

    public function findBookByISBN(string $isbn): ?Book
    {
        foreach ($this->books as $book) {
            if ($book->getISBN() === $isbn) {
                return $book;
            }
        }

        return null;
    }

    public function findReaderById(string $readerId): ?Reader
    {
        foreach ($this->readers as $reader) {
            if ($reader->getReaderId() === $readerId) {
                return $reader;
            }
        }

        return null;
    }

    public function showAllBooks(): string
    {
        if (empty($this->books)) {
            return "Книг в библиотеке нет.";
        }

        $list = "Все книги:</br>";
        foreach ($this->books as $book) {
            $list .= "- " . $book->getInfo() . "</br>";
        }

        return $list;
    }

    public function showAllReaders(): string
    {
        if (empty($this->readers)) {
            return "Нет зарегистрированных читателей.";
        }

        $list = "Все читатели:</br>";
        foreach ($this->readers as $reader) {
            $list .= "- {$reader->name} (ID: {$reader->getReaderId()})</br>";
        }

        return $list;
    }

    public function getStatistics(): string
    {
        $totalBooks = count($this->books);

        $availableBooks = 0;
        foreach ($this->books as $book) {
            if ($book->checkAvailability()) {
                $availableBooks++;
            }
        }

        $readersCount = count($this->readers);

        return "Библиотека: {$this->name}</br>".
            "Всего книг: {$totalBooks}</br>".
            "Доступно книг: {$availableBooks}</br>".
            "Зарегистрировано читателей: {$readersCount}</br>";
    }
}
