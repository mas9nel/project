<?php
    class Audit{
        public function bind($key, $value){
            $this->$key = $value;
        }
        function print($property, $alt = ""){
            echo ($this->$property)? $this->$property : $alt;
        }
    }