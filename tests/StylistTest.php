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

        function testSave()
        {
          // Arrange
          $name = "Alison";
          $test_stylist = new Stylist($name);

          // Act
          $executed = $test_stylist->save();

          // Assert
          $this->assertTrue($executed, "Stylist not successfully saved to database");
        }

        function testGetId()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            // Act
            $result = $test_stylist->getId();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

    }

?>
