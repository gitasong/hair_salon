<?php

    class Client
    {
        private $name;
        private $tylist_id;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->$tylist_id;
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

    }

?>
