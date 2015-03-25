<?php

    /**
    * @BackupGlobals disabled
    * @BackupStaticAttributes disabled
    */

    require_once "src/Book.php";

    // $DB = new PDO('pgsql:host=localhost;dbname=Library');

    Class BookTest extends PHPUnit_Framework_TestCase
    {

        function test_getAuthorName()
        {
            //Arrange
            $author = "Jane Olstin";
            $title = "Pride and Prejudice";
            $id = null;
            $test_book = new Book($author, $title, $id);

            //Act
            $result = $test_book->getAuthor();

            //Assert
            $this->assertEquals("Jane Olstin", $result);

        }


        function test_setAuthorName()
        {
            //Arrange
            $author = "Erica Cha";
            $title = "Charlotte's Web";
            $id = null;
            $test_book = new Book($author, $title, $id);
            $new_author = "Jonathan Lin";

            //act
            $test_book->setAuthor($new_author);
            $result = $test_book->getAuthor();

            //assert
            $this->assertEquals("Jonathan Lin", $result);
        }

        function test_getTitle()
        {
            //Arrange
            $author = "Erica Cha";
            $title = "Charlotte's Web";
            $id = null;
            $test_book = new Book($author, $title, $id);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals("Charlotte's Web", $result);

        }

        function test_setTitle()
        {
            //Arrange
            $author = "J.K. Rowling";
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($author, $title, $id);
            $new_title = "Chamber of Secrets";

            //Act
            $test_book->setTitle($new_title);
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals("Chamber of Secrets", $result);
        }

        function test_getId()
        {
            //Arrange
            $author = "J.K. Rowling";
            $title = "Prisoner of Azkaban";
            $id = 1;
            $test_book = new Book($author, $title, $id);

            //Act
            $result = $test_book->getId();

            //Assert
            $this->assertEquals(1, $result);
        }


    }


?>
