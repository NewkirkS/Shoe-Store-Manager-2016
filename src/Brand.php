<?php

    class Brand
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands");
            $brands = array();

            foreach($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN brands_stores
            ON (brands_stores.brand_id = brands.id)
            JOIN stores
            ON (stores.id = brands_stores.store_id)
            WHERE brands.id = {$this->getId()};");

            $stores = array();

            foreach($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];

                $new_store = new Store($name, $id);

                array_push($stores, $new_store);
            }
            return $stores;
        }

    }

 ?>
