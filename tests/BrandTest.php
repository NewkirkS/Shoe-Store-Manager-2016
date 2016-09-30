<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Brand::deleteAll();
        //     Store::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "Niqee";
            $test_brand = new Brand($name);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Niqee";
            $test_brand = new Brand($name);
            $new_name = "Lawsuit";

            //Act
            $test_brand->setName($new_name);

            //Assert
            $this->assertEquals($new_name, $test_brand->getName());
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "Niqee";
            $test_brand = new Brand($name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }
    }

 ?>
