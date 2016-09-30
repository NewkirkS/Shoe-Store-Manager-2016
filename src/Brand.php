<?php

    class Brand
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->$id = $id;
        }

        function getId()
        {
            return $this->Id;
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

        }

        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        static function find($search_id)
        {

        }

        function addStore($store)
        {

        }

        function getStores()
        {
            
        }

    }

 ?>
