<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    // require_once "src/Stylist.php"

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Client::deleteAll();
          Stylist::deleteAll();
        }

        function testGetName()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);

            // Act
            $result = $test_client->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);
            $new_name = "Mr. F.";

            // Act
            $test_client->setName($new_name);
            $result = $test_client->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetStylistID()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);

            // Act
            $result = $test_client->getStylistID();

            // Assert
            $this->assertEquals($stylist_id, $result);
        }

        function testSetStylistID()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);
            $new_stylist_id = 4;

            // Act
            $test_client->setStylistID($new_stylist_id);
            $result = $test_client->getStylistID();

            // Assert
            $this->assertEquals($new_stylist_id, $result);
        }

        function testSave()
        {
          // Arrange
          $name = "Mrs. N.";
          $stylist_id = 3;
          $test_client = new Client($name, $stylist_id);

          // Act
          $executed = $test_client->save();

          // Assert
          $this->assertTrue($executed, "Client not successfully saved to database");
        }

        function testGetID()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();

            // Act
            $result = $test_client->getID();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetAll()
        {
          // Arrange
          $name = "Mrs. N.";
          $stylist_id = 3;
          $test_client = new Client($name, $stylist_id);
          $test_client->save();

          $name_2 = "Mrs. D.";
          $stylist_id_2 = 4;
          $test_client_2 = new Client($name_2, $stylist_id_2);
          $test_client_2->save();

          // Act
          $result = Client::getAll();

          // Assert
          $this->assertEquals([$test_client, $test_client_2], $result);
        }

        function testDeleteAll()
        {
            // Arrange
            $name = "Mrs. N.";
            $stylist_id = 3;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();

            $name_2 = "Mrs. D.";
            $stylist_id_2 = 4;
            $test_client_2 = new Client($name_2, $stylist_id_2);
            $test_client_2->save();

            // Act
            Client::deleteAll();
            $result = Client::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

    //     function testFind()
    //     {
    //         // Arrange
    //         $name = "Mrs. N.";
    //         $test_client = new Client($name, $stylist_id);
    //         $test_client->save();
    //
    //         $name2 = "Mrs. D.";
    //         $test_client_2 = new Client($name2);
    //         $test_client_2->save();
    //
    //         // Act
    //         $result = Client::find($test_client->getID());
    //
    //         // Assert
    //         $this->assertEquals($test_client, $result);
    //     }
    //
    //     function testUpdate()
    //     {
    //         // Arrange
    //         $name = "Mrs. N.";
    //         $test_client = new Client($name, $stylist_id);
    //         $test_client->save();
    //         $new_name = "Mr. F.";
    //
    //         // Act
    //         $test_client->update($new_name);
    //
    //         // Assert
    //         $this->assertEquals("Mr. F.", $test_client->getName());
    //     }
    //
    //     function testDelete()
    //     {
    //         // Arrange
    //         $name = "Mrs. N.";
    //         $test_client = new Client($name, $stylist_id);
    //         $test_client->save();
    //
    //         $name_2 = "Mrs. D.";
    //         $test_client_2 = new Client($name_2, $stylist_id_2);
    //         $test_client_2->save();
    //
    //         // Act
    //         $test_client->delete();
    //
    //         // Assert
    //         $this->assertEquals([$test_client_2], Client::getAll());
    //     }
    //
    }

?>
