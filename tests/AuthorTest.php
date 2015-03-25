<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disbaled
    */

    require_once "src/Author.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class AuthorTest extends PHPUnit_Framework_TestCase
    {

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

}



?>
