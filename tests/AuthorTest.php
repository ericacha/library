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
}



?>
