<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disbaled
    */

    require_once "src/Patron.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class PatronTest extends PHPUnit_Framework_TestCase
    {


        function test_getPatronName()
        {
            //Assert
            $patron_name = "Loral";
            $id = null;
            $test_patron = new Patron($patron_name, $id);

            //Act
            $result = $test_patron->getPatronName();

            //Assert
            $this->assertEquals('Loral', $result);

        }

        // function setPatronName()
        // {
        //     //Assert
        //     $name = "Loral";
        //     $id = null;
        //     $test_patron = new Patron($name, $id);
        //
        // }
    }

?>
