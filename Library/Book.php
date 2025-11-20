<?php

class Book
{
    public string $title;
    public string $author;

    private string $isbn;
    private bool $isAvailable = true;

    public function __construct(string $title, string $author, string $isbn)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }

    public function getISBN(): string
    {
        return $this->isbn;
    }

    public function checkAvailability(): bool
    {
        return $this->isAvailable;
    }

    public function borrow(): bool
    {
        if (!$this->isAvailable) {
            return false;
        }
        
        $this->isAvailable = false;
        return true;
    }

    public function returnBook(): void
    {
        $this->isAvailable = true;
    }

    public function getInfo(): string
    {
        return "<b>Название</b>: {$this->title}, <b>Автор</b>: {$this->author}, <b>ISBN</b>: {$this->isbn}";
    }
}
