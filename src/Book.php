<?php

    class Book
    {


            private $title;
            private $id;


            function __construct($title, $id = null)
            {
                $this->title = $title;
                $this->id = $id;
            }

            function getTitle()
            {
                return $this->title;
            }

            function setTitle($new_title)
            {
                $this->title = $new_title;
            }

            function getId()
            {
                return $this->id;
            }

            function setId($new_id)
            {
                $this->id = $new_id;
            }

            function save()
            {
                $statement = $GLOBALS['DB']->query("INSERT INTO books(title) VALUES ('{$this->getTitle()}') RETURNING id;");
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $this->setId($result['id']);
            }


            function updateTitle($new_title)
            {
                $GLOBALS['DB']->exec("UPDATE books SET title = '{$new_title}';");
                $this->setTitle($new_title);
            }

            function singleDelete()
            {
                $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
                $GLOBALS['DB']->exec("DELETE FROM authors_books WHERE id = {$this->getId()};");

            }


            function addAuthor($author)
            {
                var_dump($author);
                $GLOBALS['DB']->exec("INSERT INTO authors_books (authors_id, books_id) VALUES ({$author->getId()}, {$this->getId()});");
            }



            function getAuthors()
            {
                $query = $GLOBALS['DB']->query("SELECT authors.* FROM books JOIN authors_books ON (authors_books.books_id = books.id) JOIN authors ON (authors_books.authors_id = authors.id) WHERE books.id = {$this->getId()};");
                $query_fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                $array1 = array();

                foreach ($query_fetch as $element)
                {
                    $new_name = $element['name'];
                    $new_id = $element['id'];
                    $new_author = new Author($new_name, $new_id);
                    array_push($array1, $new_author);
                }
                return $array1;

            }



            static function getAll()
            {
                $statement = $GLOBALS['DB']->query("SELECT * FROM books;");
                $book_array = $statement->fetchAll(PDO::FETCH_ASSOC);
                $return_array = array();

                foreach ($book_array as $book)
                {
                    $title = $book['title'];
                    $id = $book['id'];
                    $new_book = new Book($title, $id);
                    array_push($return_array, $new_book);
                }
            return $return_array;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM books *;");
            }

            static function findId($search_id)
            {
                $statement = $GLOBALS['DB']->query("SELECT * FROM books WHERE id = {$search_id};");
                $book_array = $statement->fetchAll(PDO::FETCH_ASSOC);
                $return_book = null;

                foreach ($book_array as $book)
                {
                    $title = $book['title'];
                    $id = $book['id'];
                    $return_book = new Book($title, $id);
                }
                return $return_book;
            }

            static function findByTitle($search_title)
            {
                $statement_pdo = $GLOBALS['DB']->query("SELECT * FROM books WHERE title = '{$search_title}';");
                $statement = $statement_pdo->fetchAll(PDO::FETCH_ASSOC);
                $return_book = null;

                foreach ($statement as $book)
                {
                    $new_title = $book['title'];
                    $new_id = $book['id'];
                    $return_book = new Book($new_title, $new_id);
                }
                return $return_book;
            }









    }
?>
