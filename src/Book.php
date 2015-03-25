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
}
?>
