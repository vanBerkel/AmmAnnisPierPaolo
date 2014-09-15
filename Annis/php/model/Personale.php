<?php
/**
 * Description of Cliente
 *
 * @author Pier
 */
class Personale {
    private $username;
    private $password;
    private $nome;
    private $cognome;
    private $telefono;
    private $email;
    private $indirizzo;
    private $cap;
    private $citta;
    private $data;
    private $mansione;
    
    public function __construct() {
        
    }
   
   /**
     * Verifica se l'utente esista per il sistema
     * @return boolean true se l'utente esiste, false altrimenti
     */
    public function esiste() {
        // implementazione di comodo, va fatto con il db
       // return isset($this->idCliente);
        
        
    }
    
    /**
     * Restituisce lo username dell'utente
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Imposta lo username per l'autenticazione dell'utente. 
     * I nomi che si ritengono validi contengono solo lettere maiuscole e minuscole.
     * La lunghezza del nome deve essere superiore a 5
     * @param string $username
     * @return boolean true se lo username e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setUsername($username) {
        // utilizzo la funzione filter var specificando un'espressione regolare
        // che implementa la validazione personalizzata
       /***** if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }*/
        $this->username = $username;
        return true;
    }

    /**
     * Restituisce la password per l'utente corrente
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Imposta la password per l'utente corrente
     * @param string $password
     * @return boolean true se la password e' stata impostata correttamente,
     * false altrimenti
     */
    public function setPassword($password) {
        $this->password = $password;
        return true;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return true;
    }
    
    /**
     * Restituisce il nome dell'utente
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

     /**
     * Imposta il nome dell'utente
     * @param string $nome
     * @return boolean true se il nome e' stato impostato correttamente, 
     * false altrimenti 
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    /**
     * Restituisce il cognome dell'utente
     * @return string
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Imposta il cognome dell'utente
     * @param string $cognome
     * @return boolean true se il cognome e' stato impostato correttamente,
     * false altrimenti
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }
    
   
    public function setIndirizzo($indirizzo) {
        $this->indirizzo = $indirizzo;
        return true;
    }
    public function getIndirizzo() {
        return $this->indirizzo;
    }

   
    public function setEmail($email) {
        $this->email = $email;
        return true;
    }
    public function getEmail() {
        return $this->email;
    }
     
    public function setCap($cap) {
        $this->cap = $cap;
        return true;
    }
    public function getCap() {
        return $this->cap;
    }
    
    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }
    public function getCitta() {
        return $this->citta;
    }
    
    public function setData($data) {
        $this->data = $data;
        return true;
    }
    
    public function getData() {
        return $this->data;
    }
    
    /**
     * Compara due utenti, verificandone l'uguaglianza logica
     * @param User $user l'utente con cui comparare $this
     * @return boolean true se i due oggetti sono logicamente uguali, 
     * false altrimenti
     */
    public function equals(User $user) {

        return  $this->username == $user->username &&
                $this->cognome == $user->cognome &&
                $this->nome == $user->nome;
    }
    
}
