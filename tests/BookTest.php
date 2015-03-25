<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();

        }

        function test_updateAuthor()
        {
            //arrange
            $author = "Yo Man";
            $title = "Johnny Boy";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            //act
            $new_author = "Brian Kropff";
            $test_book->updateAuthor($new_author);
            $result = $test_book->getAuthor();

            //assert
            $this->assertEquals("Brian Kropff", $result);
        }

        function test_UpdateAuthorDatabase()
        {
            //arrange
            $author = "Tolkien";
            $title = "LoTR";
            $test_book = new Book($author, $title);
            $test_book->save();
            $new_author = "J.R.R";

            //act
            $test_book->updateAuthor($new_author);
            $all_books = Book::getAll();
            $result = $all_books[0]->getAuthor();

            //asert
            $this->assertEquals("J.R.R", $result);
        }

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

        function test_setId()
        {
            //Arrange
            $author = "J.K. Rowling";
            $title = "Prisoner of Azkaban";
            $id = 1;
            $test_book = new Book($author, $title, $id);
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
            $author = "Dr. Suess";
            $title = "Hop On Pop";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book] ,$result );


        }

        function test_getAll()
        {
            //Arrange
            $author = "Dr. Suess";
            $title = "Hop On Pop";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            $author2 = "R.L Stine";
            $title2 = "Scary Boo";
            $test_book2 = new Book($author2, $title2);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book,$test_book2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $author = "Yo Man";
            $title = "Johnny Boy";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            $author2 = "R.L Stine";
            $title2 = "Scary Boo";
            $test_book2 = new Book($author2, $title2);
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
            $author = "Yo Man";
            $title = "Johnny Boy";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            $author2 = "Cool";
            $title2 = "Dude Guide";
            $id2 = 2;
            $test_book2 = new Book($author2,$title2, $id2);
            $test_book2->save();

            //Act
            $result = Book::findID($test_book2->getID());

            //Assert
            $this->assertEquals($test_book2, $result);
        }

        function test_updateTitle()
        {
            //Arrange
            $author = "Miriam King";
            $title = "Roses Are Red";
            $id = 1;
            $test_book = new Book($author, $title, $id);
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
            $author = "Miriam King";
            $title = "Roses Are Red";
            $id = 1;
            $test_book = new Book($author, $title, $id);
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
            $author = "Joe Smith";
            $title = "Bad gum";
            $id = 1;
            $test_book = new Book($author, $title, $id);
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
            $author = "F.Scott Fizgerald";
            $title = "Great Gatsby";
            $test_book = new Book($author, $title);
            $test_book->save();

            $author1 = "Anne Rice";
            $title1 = "Whatever";
            $test_book1 = new Book($author1, $title1);
            $test_book1->save();

            $title_search = "Whatever";

            //Act
            $result = Book::findByTitle($title_search);

            //Assert
            $this->assertEquals($test_book1, $result);
        }



    }


?>
