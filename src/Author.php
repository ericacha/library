<?php
    class Author
    {
            private $name;
            private $id;



            function __construct($name,$id = null)
            {
                $this->name = $name;
                $this->id = $id;
            }

            function getName()
            {
                return $this->name;
            }

            function setName($new_name)
            {
                $this->name = $new_name;
            }

            function getId()
            {
                return $this->id;
            }

            function setId($new_id)
            {
                $this->id = (int) $new_id;
            }

            function save()
            {
                $statement = $GLOBALS['DB']->query("INSERT INTO authors(name) VALUES ('{$this->getName()}') RETURNING id;");
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $this->setId($result['id']);
            }

            function updateName($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE authors SET name = '{$new_name}' WHERE id = {$this->getId()} ;");
                $this->setName($new_name);
                }

            function singleDelete()
            {
                $GLOBALS['DB']->exec("DELETE FROM authors WHERE id = {$this->getId()};");
            }

            function addBook($title)
            {
                $GLOBALS['DB']->exec("INSERT INTO authors_books(authors_id, books_id) VALUES  ({$this->getId()},{$title->getId()});");
            }

            function getBooks()
            {
                $query = $GLOBALS['DB']->query("SELECT books.* FROM books JOIN authors_books ON (books.id = authors_books.books_id) JOIN authors ON( authors.id = authors_books.authors_id) WHERE authors.id = {$this->getId()};");
                $query_fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                $array1 = array();

                foreach ($query_fetch as $element)
                {
                    $new_id = $element['id'];
                    $new_title = $element['title'];
                    $new_book = new Book($new_title, $new_id);
                    array_push ($array1, $new_book);
                }
                return $array1;
            }

            static function findId($search_id)
            {

                $statement = $GLOBALS['DB']->query("SELECT *  FROM authors WHERE id = {$search_id};");
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $found_author = null;

                foreach($results as $element)
                {
                    $new_id = $element['id'];
                    $new_name = $element['name'];
                    $found_author = new Author($new_name, $new_id);
                }
                return $found_author;
            }


            // An author can have many books. Might need to change $found_name to an array
            static function findName($search_name)
            {
                $statement = $GLOBALS['DB']->query("SELECT * FROM authors WHERE name = '{$search_name}';");
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $found_name_array = array();

                foreach($results as $name)
                {
                    $new_name = $name['name'];
                    $new_id = $name['id'];
                    $found_name = new Author($new_name, $new_id);
                    array_push($found_name_array, $found_name);
                }
                return $found_name_array;

            }

            static function getAll()
            {
                $statement = $GLOBALS['DB']->query("SELECT * FROM authors;");
                $author_array = $statement->fetchAll(PDO::FETCH_ASSOC);
                $return_author = array();

                foreach($author_array as $author)
                {
                    $new_name = $author['name'];
                    $new_id = $author['id'];
                    $new_Author = new Author($new_name, $new_id);
                    array_push($return_author, $new_Author);
                }
                return $return_author;

            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM authors *;");
                $GLOBALS['DB']->exec("DELETE FROM authors_books *;");

            }





    }

?>
