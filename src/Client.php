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

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $client_id = $client['id'];
                $new_client = new Client($client_name, $stylist_id, $client_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id");
            $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_clients->execute();
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $client_id = $client['id'];
                if ($client_id == $search_id) {
                    $found_client = new Client($client_name, $stylist_id, $client_id);
                }
            }
            return $found_client;
        }

    }

?>
