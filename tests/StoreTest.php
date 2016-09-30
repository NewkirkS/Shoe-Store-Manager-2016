<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

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

        function test_save()
       {
           //Arrange
           $id = 1;
           $name = "Shoe Empire";
           $test_store = new Store($name, $id);

           //Act
           $test_store->save();
           $result = Store::getAll();

           //Assert
           $this->assertEquals([$test_store], $result);
       }

       function test_getAll()
      {
          //Arrange
          $name = "Heavenly Boots";
          $test_store = new Store($name);
          $test_store->save();

          $name2 = "Spider Shoes";
          $test_store2 = new Store($name2);
          $test_store2->save();

          //Act
          $result = Store::getAll();

          //Assert
          $this->assertEquals([$test_store, $test_store2], $result);
      }

      function test_deleteAll()
     {
         //Arrange
         $name = "Heavenly Boots";
         $test_store = new Store($name);
         $test_store->save();

         $name2 = "Spider Shoes";
         $test_store2 = new Store($name2);
         $test_store2->save();

         //Act
         $result = Store::getAll();

         //Assert
         $this->assertEquals([$test_store, $test_store2], $result);
     }

     function test_find()
    {
        //Arrange
        $name = "Heavenly Boots";
        $test_store = new Store($name);
        $test_store->save();

        $name2 = "Spider Shoes";
        $test_store2 = new Store($name2);
        $test_store2->save();

        //Act
        $search_id = $test_store2->getId();
        $result = Store::find($search_id);

        //Assert
        $this->assertEquals($test_store2, $result);
    }

    }

 ?>
