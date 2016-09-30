<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

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

        function test_save()
       {
           //Arrange
           $name = "Niqee";
           $test_brand = new Brand($name);

           //Act
           $test_brand->save();
           $result = Brand::getAll();

           //Assert
           $this->assertEquals([$test_brand], $result);
       }

       function test_getAll()
      {
          //Arrange
          $name = "Niqee";
          $test_brand = new Brand($name);
          $test_brand->save();

          $name2 = "Sadida";
          $test_brand2 = new Brand($name2);
          $test_brand2->save();

          //Act
          $result = Brand::getAll();

          //Assert
          $this->assertEquals([$test_brand, $test_brand2], $result);
      }

      function test_deleteAll()
     {
         //Arrange
         $name = "Niqee";
         $test_brand = new Brand($name);
         $test_brand->save();

         $name2 = "Sadida";
         $test_brand2 = new Brand($name2);
         $test_brand2->save();

         //Act
         $result = Brand::getAll();

         //Assert
         $this->assertEquals([$test_brand, $test_brand2], $result);
     }

     function test_find()
    {
        //Arrange
        $name = "Niqee";
        $test_brand = new Brand($name);
        $test_brand->save();

        $name2 = "Sadida";
        $test_brand2 = new Brand($name2);
        $test_brand2->save();

        //Act
        $search_id = $test_brand2->getId();
        $result = Brand::find($search_id);

        //Assert
        $this->assertEquals($test_brand2, $result);
    }

    }

 ?>
