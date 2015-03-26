<?php

    class Patron

    {
        private $patron_name;
        private $id;

        function __construct($patron_name, $id = null)
        {
            $this->patron_name = $patron_name;
            $this->id =$id;
        }

        function getPatronName()
        {
            return $this->patron_name;

        }

        function setPatronName($new_patron_name)
        {
            $this->patron_name = (string) $new_patron_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO patrons (patron_name) VALUES ('{$this->getPatronName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patron_array = $statement->fetchAll(PDO::FETCH_ASSOC);
            $return_array = array();

            foreach($patron_array as $patrons)
            {
                $patron_name = $patrons['patron_name'];
                $id = $patrons['id'];
                $new_patron = new Patron($patron_name, $id);
                array_push($return_array, $new_patron);
            }
            return $return_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons *;");
        }


        function updatePatron($new_patron_name)
        {
            $GLOBALS['DB']->exec("UPDATE patrons SET patron_name = '{$new_patron_name}';");
            $this->setPatronName($new_patron_name);
        }




    }

?>
