<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disbaled
    */

    require_once "src/Author.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class AuthorTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Author::deleteAll();
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
}



?>
