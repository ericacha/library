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
                $this->id = $new_id;
            }

            function save()
            {
                $statement = $GLOBALS['DB']->query("INSERT INTO authors(name) VALUES ('{$this->getName()}') RETURNING id;");
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $this->setId($result['id']);
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
            }

    }

?>
