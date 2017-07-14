<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        function testGetName()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);

            // Act
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

    }

?>
