<?php
/**
 * Description of Specie
 *
 * @author Pier
 */
class Specie{
    private $id;
    private $nome;
    private $immagine;
    private $descrizione;
    private $Descrizione;
    private $infoMetodoColt;
    private $CarEsposizione;
 
   
    public function __construct() {    
    }
    public function getId() {
        return $this->id;
    }
       
    public function setId($id) {
        $this->id = $id;
        return true;
    } 

    public function getImmagine() {
        return $this->immagine;
    }
       
    public function setImmagine($immagine) {
        $this->immagine = $immagine;
        return true;
    }
    public function getNome() {
        return $this->nome;
    }
       
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }
    public function getDescrizione() {
        return $this->descrizione;
    }
       
    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
        return true;
    }
    public function setCarEsposizione($carEsposizione) {
        $this->CarEsposizione = (intval($carEsposizione));
        return true;
    }
    public function getInfoMetodoColt() {
        return $this->infoMetodoColt;
    }
       
    public function setInfoMetodoColt($infoMetodoColt) {
        $this->infoMetodoColt = intval($infoMetodoColt);
        return true;
    }
    public function getCarEsposizione() {
        return $this->CarEsposizione;
    }
   
 
    
}
