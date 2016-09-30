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

        function test_getBrands()
        {
            //Arrange
            $brand_name = "Niqee";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Niqeeeee";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            $name = "Heavenly Boots";
            $test_store = new Store($name);
            $test_store->save();

            //Act
            $test_store->addBrand($test_brand2);

            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand2], $result);
        }

        function test_addBrand()
        {
            //Arrange
            $brand_name = "Niqee";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $name = "Heavenly Boots";
            $test_store = new Store($name);
            $test_store->save();

            //Act
            $test_store->addBrand($test_brand);

            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_delete()
        {
            //Arrange
            $name = "Heavenly Boots";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "Hellish Heels";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Heavenly Boots";
            $test_store = new Store($name);
            $test_store->save();
            $new_name = "Boot Loot";

            //Act
            $test_store->update($new_name);
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

    }

 ?>
