<?php
class Data{

   
    private $giorno;
    
    public function __construct() {    
    }
    
    public function getGiorno() {
        return $this->giorno;
    }
       
    public function setGiorno($giorno) {
        $this->giorno = $giorno;
        return true;
    } 

}
