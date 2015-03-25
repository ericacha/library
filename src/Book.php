<?php

class Book
{

        private $author;
        private $title;
        private $id;


        function __construct($author, $title, $id = null)
        {
            $this->author = $author;
            $this->title = $title;
            $this->id = $id;
        }

        function getAuthor()
        {
            return $this->author;
        }

        function setAuthor($new_author)
        {
            $this->author = $new_author;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO books(author,title) VALUES ('{$this->getAuthor()}', '{$this->getTitle()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function updateAuthor($new_author)
        {
            $GLOBALS['DB']->exec("UPDATE books SET author = '{$new_author}';");
            $this->setAuthor($new_author);
        }

        function updateTitle($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE books SET title = '{$new_title}';");
            $this->setTitle($new_title);
        }

        function singleDelete()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
        }






        static function getAll()
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM books;");
            $book_array = $statement->fetchAll(PDO::FETCH_ASSOC);
            $return_array = array();

            foreach ($book_array as $book)
            {
                $author = $book['author'];
                $title = $book['title'];
                $id = $book['id'];
                $new_book = new Book($author, $title, $id);
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
                $author = $book['author'];
                $title = $book['title'];
                $id = $book['id'];
                $return_book = new Book($author, $title, $id);

            }
            return $return_book;
        }








}
?>
