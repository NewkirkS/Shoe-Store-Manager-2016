<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Brand::deleteAll();
        //     Store::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "Shoe Empire";
            $test_store = new Store($name);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Shoe Empire";
            $test_store = new Store($name);
            $new_name = "Sandal Bros.";

            //Act
            $test_store->setName($new_name);

            //Assert
            $this->assertEquals($new_name, $test_store->getName());
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "Shoe Empire";
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }
    }

 ?>
