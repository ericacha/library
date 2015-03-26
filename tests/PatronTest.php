<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disbaled
    */

    require_once "src/Patron.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Patron::deleteAll();
        }


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

        function test_save()
        {
            //Assert
            $patron_name = "William";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron], $result);
        }

        function test_getAll()
        {
            $patron_name = "Cassidy";
            $id = 2;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            $patron_name1 = "Noel";
            $id1 = 3;
            $test_patron1 = new Patron($patron_name1, $id1);
            $test_patron1->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron, $test_patron1], $result);
        }

        function test_deleteAll()
        {
            $patron_name = "Kels";
            $id = 1;
            $test_patron = new Patron($patron_name,$id);
            $test_patron->save();

            $patron_name2 = "Luke";
            $id2= 2;
            $test_patron2 = new Patron($patron_name2, $id2);
            $test_patron2->save();

            //Act
            Patron::deleteAll();
            $result = $test_patron->getAll();

            //Assert
            $this->assertEquals([], $result);


        }

        function test_updatePatron()
        {
            //Arrange
            $patron_name = "Lucky";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            //Act
            $new_patron_name= "Daisy";
            $test_patron->updatePatron($new_patron_name);
            $result = Patron::getAll();


            //Assert
            $this->assertEquals('Daisy',$result[0]->getPatronName());
        }

    }

?>
