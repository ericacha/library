<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";
    require_once "src/Author.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
            Author::deleteAll();

        }


        function test_getTitle()
        {
            //Arrange

            $title = "Charlotte's Web";
            $id = null;
            $test_book = new Book($title, $id);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals("Charlotte's Web", $result);

        }

        function test_setTitle()
        {
            //Arrange
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);
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

            $title = "Prisoner of Azkaban";
            $id = 1;
            $test_book = new Book($title, $id);

            //Act
            $result = $test_book->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange

            $title = "Prisoner of Azkaban";
            $id = 1;
            $test_book = new Book($title, $id);
            $new_id = 2;

            //Act
            $test_book->setId($new_id);
            $result = $test_book->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $title = "Hop On Pop";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book] ,$result );


        }

        function test_getAll()
        {
            //Arrange

            $title = "Hop On Pop";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();


            $title2 = "Scary Boo";
            $test_book2 = new Book($title2);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book,$test_book2], $result);
        }

        function test_deleteAll()
        {
            //Arrange

            $title = "Johnny Boy";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();


            $title2 = "Scary Boo";
            $test_book2 = new Book($title2);
            $test_book2->save();

            //Act
            Book::deleteAll();
            $result = Book::getALL();

            //Assert
            $this->assertEquals([], $result);
        }


        function test_findId()
        {
            //arrange

            $title = "Johnny Boy";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();


            $title2 = "Dude Guide";
            $id2 = 2;
            $test_book2 = new Book($title2, $id2);
            $test_book2->save();

            //Act
            $result = Book::findID($test_book2->getID());

            //Assert
            $this->assertEquals($test_book2, $result);
        }

        function test_updateTitle()
        {
            //Arrange

            $title = "Roses Are Red";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();

            //Act
            $new_title = "Roses Are Blue";
            $test_book->updateTitle($new_title);
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals("Roses Are Blue", $result);


        }

        function test_updateTitleDatabase()
        {
            //Arrange

            $title = "Roses Are Red";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();

            //Act
            $new_title = "Roses Are Blue";
            $test_book->updateTitle($new_title);
            $result = Book::getAll();
            $get_newTitle = $result[0]->getTitle();

            //Assert
            $this->assertEquals('Roses Are Blue', $get_newTitle);
        }

        function test_singleDelete()
        {
            //Arrange
            $title = "Bad gum";
            $id = 1;
            $test_book = new Book($title, $id);
            $test_book->save();

            //Act

            $test_book->singleDelete();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_findByTitle()
        {
            //Arrange

            $title = "Great Gatsby";
            $test_book = new Book($title);
            $test_book->save();

            $title1 = "Whatever";
            $test_book1 = new Book($title1);
            $test_book1->save();

            $title_search = "Whatever";

            //Act
            $result = Book::findByTitle($title_search);

            //Assert
            $this->assertEquals($test_book1, $result);
        }


        function test_addAuthor()
        {
            //Arrange
            $title = "Great Gatsby";
            $test_book = new Book($title);
            $test_book->save();

            $author_name = "Fitzgerald";
            $test_author = new Author($author_name);
            $test_author->save();


            //Act

            $test_book->addAuthor($test_author);
            $result = $test_book->getAuthors();

            //Arrange
            $this->assertEquals($test_author, $result[0]);
        }

        function test_getAuthors()
        {
            $title = "Great Gatsby";
            $test_book = new Book($title);
            $test_book->save();

            $author_name = "Fitzgerald";
            $test_author = new Author($author_name);
            $test_author->save();

            $author_name1 = "Scott";
            $test_author1 = new Author($author_name1);
            $test_author1->save(); 

            //Act
            $test_book->addAuthor($test_author);
            $test_book->addAuthor($test_author1);
            $result = $test_book->getAuthors();

            $this->assertEquals([$test_author, $test_author1], $result);
        }


    }


?>
