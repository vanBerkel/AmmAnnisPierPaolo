<?php
/**
 * Description of ClienteController
 *
 * @author Pier
 */

include("dbclass.php"); //connette il database

class ClienteController {
    
    public $db;
    public function __construct() {
        
    }
    
     
    

    

    public function handleInput(&$request){
       if (isset($request["cmd"])){
           switch ($request["cmd"]){
               case 'login':
                    $username = isset($request['username']) ? $request['username'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    
                    $this->loginCliente($username, $password);
                    
                    //$this->login($vd, $username, $password);
                    // questa variabile viene poi utilizzata dalla vista
                    //if ($this->loggedIn())
                      //  $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
                //default : //$this->showLoginPage();
               
           }
           
           
       }
       
 
        
        
    }
    
    
    private function loginCliente($user,$passw) {
        // chiediamo al modello di caricare i dati e li passiamo alla vista. 
        // Il passaggio e' fatto semplicemente popolando delle variabili
        // che poi vengono lette dalla vista.
        
       
        $q = "SELECT * FROM cliente
                    WHERE Username = '$user' AND Password ='$passw'";
                    $res = $db->query($q);

                    if(mysql_num_rows($res) == 1) {
                        $row = mysql_fetch_array($res);
                        $cliente = new Cliente();
                        $cliente->setUsername($user);
                        $cliente->setPassword($passw);
                        $cliente->setIdCliente($idCliente);
                        $cliente->setCognome($cognome);
                        $cliente->setNome($nome);
                        $cliente->setTelefono($telefono);
                        
                        $this->showCliente($cliente);
                    //header('Location: index.php');

                    }
                    else {?>
                    <script type="text/javascript">
                       alert('utente non trovato!');   
                    </script>
                    <?php           

        
    }
    }
    private function showCliente($cliente) {
            $_SESSION['logged'] = $cliente->getIdCliente(); //� stata trovato username e password corrispondenti
            $_SESSION['cliente'] = $cliente->getUsername();
                             


// chiediamo al modello di caricare i dati e li passiamo alla vista. 
        // Il passaggio e' fatto semplicemente popolando delle variabili
        // che poi vengono lette dalla vista.
        
        include_once('view/cliente/nav.php');
    }
}
