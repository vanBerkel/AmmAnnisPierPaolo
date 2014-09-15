<?php
class DBclass{
               //parametri per la connessione al database
				private $nomehost = 'localhost';
				private $nomeuser ='annisPierpaolo';
				private $password = 'monterosa1';
                                private $name='annisPierpaolo';
				//controllo sulle connessioni attive
				private $attiva=false;

				//nome del database
				private $nomedb= 'amm14_annisPierpaolo';
				

//funzione per la connessione a MySQL
public function connetti()
{
  if(!$this -> attiva) // '!' � la negazione
   {
        if($connessione = mysql_connect ($this->nomehost, $this->nomeuser, $this->password) or die (mysql_error()))
//funzione per connettersi a mysql
     {
        //sezione del database
        $selezione = mysql_select_db($this->nomedb,$connessione) or die (mysql_error()); // ci da un ID, e selezioniamo il database a cui cogliamo operare
     }
          else {
                 return true;
                }
    }				
}

//funzione per l'esecuzione delle Query
public function query($sql)
{
if(isset($this->attiva))
 {
  $sql = mysql_query($sql) or die (mysql_error());
  return $sql;
  } else {
    return false;
  }//se c'� una connessine attiva non fa niente altrimenti atttiva la connessione
 }//fine classe
} ?>


<?php //istanza dell'oggetto fuori dalla classe
//istanza sull'oggetto della classe
$db = new DBclass();

//connessione al database
$db ->connetti(); //si invoca il metodo connetti su qeusto oggetto
?>

