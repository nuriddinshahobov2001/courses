<?php
class Reader
{
    public string $name;

    private string $readerId;
    private array $borrowedBooks = [];

    public function __construct(string $name, string $readerId)
    {
        $this->name = $name;
        $this->readerId = $readerId;
    }

    public function getReaderId(): string
    {
        return $this->readerId;
    }

    public function borrowBook(Book $book): string
    {
        if (!$book instanceof Book) {
            return "Ошибка: передан неверный объект";
        }

        if (!$book->checkAvailability()) {
            return "Ошибка: книга \"{$book->title}\" недоступна";
        }

        $book->borrow();
        array_push($this->borrowedBooks, $book);

        return "Книга \"{$book->title}\" успешно выдана читателю {$this->name}";
    }

    public function returnBook(Book $book): string
    {
        if (!$book instanceof Book) {
            return "Ошибка: передан неверный объект";
        }

        $index = array_search($book, $this->borrowedBooks, true);
        
        if ($index !== false) {
            unset($this->borrowedBooks[$index]);
            $this->borrowedBooks = array_values($this->borrowedBooks);
            $book->returnBook();

            return "Книга \"{$book->title}\" возвращена читателем {$this->name}";
        }

        return "У читателя '{$this->name}' нет книги '{$book->title}'.";
    }

    public function getBorrowedBooks(): array
    {
        return $this->borrowedBooks;
    }

    public function getInfo(): string
    {
        $info = "Читатель: {$this->name} (ID: {$this->readerId})</br>";
        $info .= "Взятые книги:</br>";

        if (empty($this->borrowedBooks)) {
            $info .= "- Нет</br>";
        } else {
            foreach ($this->borrowedBooks as $book) {
                $info .= "- {$book->title} ({$book->author})</br>";
            }
        }

        return $info;
    }
}
