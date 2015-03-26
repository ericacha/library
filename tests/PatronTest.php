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

        function setPatronName()
        {
            //Assert
            $patron_name = "Loral";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $new_patron_name = "Kim";

            //Act
            $test_patron = setPatronName($new_patron_name);
            $result = $test_patron->getPatronName();

            //Assert
            $this->assertEquals($test_patron, $result);
        }

        function test_getId()
        {
            //Assert
            $patron_name = "Lyle";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);

            //Act
            $result = $test_patron->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Assert
            $patron_name = "Lisa";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);
            $new_id = 5;

            //Act
            $test_patron->setId($new_id);
            $result = $test_patron->getId();

            //Assert
            $this->assertEquals(5, $result);
        }


    }

?>
