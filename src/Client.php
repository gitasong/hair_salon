<?php

    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($name, $stylist_id = null, $id = null)
        {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setStylistID($new_stylist_id)
        {
            $this->stylist_id = (int) $new_stylist_id;
        }

        function getStylistID()
        {
            return $this->stylist_id;
        }

        function getID()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', '{$this->getStylistID()}')");
            if ($executed) {
                $this->id= $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

    }

?>
