<?php
require_once "Library/Book.php";
require_once "Library/Library.php";
require_once "Library/Reader.php";

// Создаём библиотеку
$library = new Library("Центральная библиотека");

// Добавляем книги
$book1 = new Book("Война и мир", "Лев Толстой", "978-5-17-123456-7");
$book2 = new Book("Преступление и наказание", "Фёдор Достоевский", "978-5-17-234567-8");
$book3 = new Book("Мастер и Маргарита", "Михаил Булгаков", "978-5-17-345678-9");

$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Регистрируем читателей
$reader1 = new Reader("Иван Иванов", "R001");
$reader2 = new Reader("Мария Петрова", "R002");

$library->registerReader($reader1);
$library->registerReader($reader2);

// Читатель берёт книгу
echo $reader1->borrowBook($book1) . "</br>";
echo $reader1->borrowBook($book2) . "</br>";

// Попытка взять уже выданную книгу
echo $reader2->borrowBook($book1) . "</br>";

// Информация о читателе
echo "</br>" . $reader1->getInfo() . "</br>";

// Возврат книги
echo "</br>" . $reader1->returnBook($book1) . "</br>";

// Теперь другой читатель может взять книгу
echo $reader2->borrowBook($book1) . "</br>";

// Статистика библиотеки
echo "</br>--- Статистика библиотеки ---</br>";
echo $library->getStatistics();

echo "</br>--- Зарегистрированных читателей. ---</br>";
echo $library->showAllReaders();
echo "</br>--- Книг в библиотеке. ---</br>";
echo $library->showAllBooks();