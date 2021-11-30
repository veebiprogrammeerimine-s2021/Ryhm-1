<?php
    class Test {
        //muutujad ehk omadused (properties)
        private $secret_number = 4;
        public $public_number = 3;
        private $received_number;
        
        //funktsioonid ehk meetodid (methods)
        //constructor
        function __construct($received_number){
            echo "Klass alustas!";
            $this->received_number = $received_number;
            $this->multiply();
        }
        
        function __destruct(){
            echo " Klass lõpetas!";
        }
        
        private function multiply(){
            echo " Salajaste arvude korrutis on: " .$this->secret_number * $this->received_number; 
        }
        
        public function reveal(){
            echo " Salajane number on: " .$this->secret_number;
        }
    }//class lõppeb