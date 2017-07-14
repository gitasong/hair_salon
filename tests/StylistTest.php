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

        protected function tearDown()
        {
          Stylist::deleteAll();
        }

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

        function testSetName()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $new_name = "Tricia";

            // Act
            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($new_name, $result);
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
            $result = $test_stylist->getID();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetAll()
        {
          // Arrange
          $name = "Alison";
          $test_stylist = new Stylist($name);
          $test_stylist->save();

          $name_2 = "Becky";
          $test_stylist_2 = new Stylist($name_2);
          $test_stylist_2->save();

          // Act
          $result = Stylist::getAll();

          // Assert
          $this->assertEquals([$test_stylist, $test_stylist_2], $result);
        }

        function testDeleteAll()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name_2 = "Becky";
            $test_stylist_2 = new Stylist($name_2);
            $test_stylist_2->save();

            // Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Becky";
            $test_stylist_2 = new Stylist($name2);
            $test_stylist_2->save();

            // Act
            $result = Stylist::find($test_stylist->getID());

            // Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $new_name = "Tricia";

            // Act
            $test_stylist->update($new_name);

            // Assert
            $this->assertEquals("Tricia", $test_stylist->getName());
        }

        function testDelete()
        {
            // Arrange
            $name = "Alison";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name_2 = "Becky";
            $test_stylist_2 = new Stylist($name_2);
            $test_stylist_2->save();

            // Act
            $test_stylist->delete();

            // Assert
            $this->assertEquals([$test_stylist_2], Stylist::getAll());
        }

        function testGetClients()
        {
            //Arrange
            $stylist_name = "Alison";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getID();

            $client_name_1 = "Mrs. N.";
            $test_client = new Client($client_name_1, $test_stylist_id);
            $test_client->save();

            $client_name_2 = "Mrs. D.";
            $test_client_2 = new Client($client_name_2, $test_stylist_id);
            $test_client_2->save();
            //Act
            $result = $test_stylist->getClients();
            //Assert
            $this->assertEquals([$test_client, $test_client_2], $result);
        }

    }

?>
