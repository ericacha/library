<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disbaled
    */

    require_once "src/Author.php";
    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class AuthorTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Lewis Smith";
            $id = null;
            $test_author = new Author($name, $id);

            //Act
            $result = $test_author->getName();

            //Assert
            $this->assertEquals('Lewis Smith', $result);

        }

        function test_setName()
        {
            //Arrange
            $name = "Lewis Smith";
            $id = null;
            $test_author = new Author($name, $id);
            $new_name = "John Do";

            //Act
            $test_author->setName($new_name);
            $result = $test_author->getName();

            //Assert
            $this->assertEquals('John Do', $result);

        }

        function test_getId()
        {
            //Arrange
            $name = "Lois Rain";
            $id = 1;
            $test_author = new Author($name, $id);

            //Act
            $result = $test_author->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_setId()
        {
            //Arrange
            $name = "Lois Rain";
            $id = 1;
            $test_author = new Author($name, $id);
            $new_id = 2;

            //Act
            $test_author->setId($new_id);
            $result = $test_author->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Lee King";
            $id = 1;
            $test_author = new Author($name, $id);
            $test_author->save();

            //Act

            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author], $result);

        }

        function test_getAll()
        {
            //Arrange
            $name = "Nolan Harris";
            $id = 1;
            $test_author = new Author($name,$id);
            $test_author->save();

            $name2 = "Mary Jones";
            $id2 = 3;
            $test_author2 = new Author($name2,$id2);
            $test_author2->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author,$test_author2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Nolan Harris";
            $id = 1;
            $test_author = new Author($name, $id);
            $test_author->save();

            //Act
            Author::deleteAll();
            $result = Author::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Lightning McQueen";
            $id = 4;
            $test_author = new Author($name, $id);
            $test_author->save();
            $new_name = "Red car";

            //Act
            $test_author->updateName($new_name);
            $result = $test_author->getName();


            //Assertåå
            $this->assertEquals('Red car', $result);


        }

        function test_findId()
        {
            //Arrange
            $name = "Heavy Mater";
            $test_author = new Author($name, 1);
            $test_author->save();

            $name1 = "Dark Matter";
            $test_author1 = new Author($name, 2);
            $test_author1->save();

            $search_id= $test_author1->getId();

            //Act
            $result = Author::findId($search_id);
            //Assert
            $this->assertEquals($test_author1, $result);
        }

        function test_findName()
        {
            //Arrange
            $name = "C.S. Lewis";
            $test_author = new Author($name);
            $test_author->save();

            $name1 = "Thomas Pynchon";
            $test_author1 = new Author($name1);
            $test_author1->save();
            $search_name = $test_author1->getName();

            $result = Author::findName($search_name);

            $this->assertEquals([$test_author1], $result);
        }


        function test_singleDelete()
        {
            //Arrange
            $name = "Ryan Smith";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Dana Snow";
            $test_author2 = new Author($name2);
            $test_author2->save();

            //Act
            $test_author2->singleDelete();
            $result = Author::getAll();


            //Assert
            $this->assertEquals([$test_author], $result);

        }
        function test_addBook()
        {
            //Arrange
            $name = "Ryan Gosling";
            $test_author = new Author($name);
            $test_author->save();

            $title = "Lady Luck";
            $test_book = new Book($title);
            $test_book->save();

            //Act
            $test_author->addBook($test_book);
            $result = $test_author->getBooks();

            //Assert
            $this->assertEquals($test_book, $result[0]);
       }

       function test_getBooks()
       {
           //Arrnage
           $name = "Ryan Gosling";
           $test_author = new Author($name);
           $test_author->save();

           $title= "Red Riding Hood";
           $test_book = new Book($title);
           $test_book->save();

           $title1 = "Robin Hood";
           $test_book1 = new Book($title1);
           $test_book1->save();

           //Act
           $test_author->addBook($test_book);
           $test_author->addBook($test_book1);
           $result = $test_author->getBooks();

           //Assert
           $this->assertEquals([$test_book, $test_book1], $result);


       }
   }



?>
