<?php
session_start();//apre la sessione
include("dbclass.php");
include("controller/functions.php");
include("controller/GeneralControl.php");
include("view/master.php");







/*
//controlla se si � rimosso qualche articolo
if(isset($_POST['job']) and $_POST['job'] == 'Rimuovi'){ 
	
	formRimuovi ($_POST['ID']);

}
//aggiorna il carrello

if(isset($_POST['job']) and $_POST['job'] == 'Richiedi'){ 
	
	formRichiedi ($_SESSION['cod'], $_POST['ID']);

}


*/

if(isset($_POST['job']) and $_POST['job'] == 'Home'){ //se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
  FormHome();
}


/*
if(isset($_POST['job']) and $_POST['job'] == 'Visualizza Catalogo'){

  
  FormVisualizza($val);
}




if(isset($_POST['job']) and $_POST['job'] == 'Modifica'){
  formModifica($_POST['ID']);
}

if(isset($_POST['job']) and $_POST['job'] == 'Salva'){
  salvaPost();
}
if (isset($_POST['job']) and $_POST['job'] == 'Cancella'){
  deletePost($_POST['ID']);
}  

if (isset($_POST['job']) and $_POST['job'] == 'Inserisci in archivio'){
  InserisciPost();
}  

*/

