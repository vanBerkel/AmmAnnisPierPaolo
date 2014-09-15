<?php

$mansione="";
if (isset($_SESSION['logged'])){
    $mansione = ReturnMansione($_SESSION['logged']);
}

$menu="";        
if (isset($_GET['menu'])){
    $menu=$_GET['menu'];
}

$job="";        
if (isset($_GET['job'])){
    $job=$_GET['job'];
}else{
    if (isset($_POST['job'])){
        $job=$_POST['job'];
    }
}

$elenco="";        
if (isset($_GET['elenco'])){
    $elenco=$_GET['elenco'];
} 

switch ($mansione){
    case "amministratore":
        $inputAdmin="";
        if (isset($_POST['admin'])){
            $inputAdmin =($_POST['admin']);
        }
        switch ($inputAdmin) {
                    case "Aggiungi":
                        if (isset($_POST['IDPianta'])&&(isset($_POST['quant']))){
                            //aggiunge una quantita stabilita di esemplari di una pianta
                            AdminAggiungiPiante($_POST['IDPianta'],$_POST['quant']);
                        }
                        if (isset($_POST['giard'])){
                            //aggiunge un nuovo giardiniere
                            $mansione="giardiniere";
                            FormAggiungiPersonale($mansione);
                        }
                        
                    case "Nuova":
                        if (isset($_POST['pianta'])){
                            //aggiunge un nuovo pianta
                            
                            FormAggiungiPianta();
                        }
                        if (isset($_POST['specie'])){
                            FormAggiungiSpecie();
                           
                       }
                        break;
                    case "Modifica":
                        
                        switch ($_POST['modifica']){
                            case "pianta":
                                
                                FormModificaPianta($_POST['IDPianta']);
                            break;
                        }
                    case "Inserisci":
                        if (isset($_POST['inserisci'])){
                        switch ($_POST['inserisci']){
                        case "pianta":                       
                            $id=CercaPianta($_POST['nome']);
                            if (($_POST['id']=='-1')&&($id==NULL)){
                                
                                  AggiungiPianta($_POST['nome'],$_POST['descrizione'],
                                            $_POST['disponibilita'],$_POST['specie'],$_POST['immagine'],$_POST['prezzo']);
                                  echo "<h2> la pianta è stata aggiunta </h2>";
                                  AdminProfilo();
                            }else{ if ($id==($_POST['id'])||(($id)==NULL)){//si tratta di una modifica
                                        ModificaPianta($_POST['id']);
                                        echo "<h2> la pianta è stata modificata </h2>";
                                            AdminProfilo();
                                    }else{
                                        echo "<p> !!!la pianta non è stata aggiunta!!! nome pianta già esistente </p>";
                                        FormModificaPianta($_POST['id']);
                                    }
                            }
                        break;
                        case "specie":
                        
                            $id=CercaSpecie($_POST['nome']);
                            if ($id==NULL){
                                  AggiungiSpecie($_POST['nome'],$_POST['descrizione']);
                                  echo "<h2> la specie è stata aggiunta </h2>";
                                  AdminProfilo();
                              }else{
                                echo "<p> !!!la specie non è stata aggiunta!!! nome specie già esistente </p>";
                                FormAggiungiSpecie();
                               }
                           
                        break;
                        case "personale":
                            $mansione="giardiniere";
                            $i=AggiungiPersonale($mansione);
                            switch ($i){
                                case 0://giardiniere aggiunto correttamente
                                    echo "<h2> il giardiniere è stato aggiunto </h2>";
                                    AdminProfilo();
                                    break;
                                case 1: //nome utente già utilizzato
                                        echo "<p> !!!il giardiniere non è stata aggiunto!!! nome utente già esistente </p>";
                                        FormAggiungiPersonale($mansione);
                                        break;
                                case 2: //la password non combaccia
                                    echo "<p> !!!il giardiniere non è stata aggiunto!!! password non corretta </p>";
                                    FormAggiungiPersonale($mansione);
                                    break;
                                case 3: // non sono stati inseriti i campi obligatori
                                    echo "<p> !!!il giardiniere non è stata aggiunto!!! non sono stati compilati tutti i campi </p>";
                                    FormAggiungiPersonale($mansione);
                                    break;
                            }
                  
                        break;    
                       
                        }
                       
                        }
                        //inserisce la pianta
                        break;
                    case "Salva" ://inserisce un nuovo giardiniere
                        
                        break;
                    default:
                        if ((($menu=="")&&($elenco=="")
                                &&($aside==""))||($menu=="profilo")){
                            AdminProfilo();
                        }
                    break;
                }
            
            
        break;
    case "cliente" :
            $cliente="";        
            if (isset($_GET['personale'])){
                $cliente=$_GET['personale'];
            }else {
                 if (isset($_POST['personale'])){
                    $cliente=$_POST['personale'];
            }
            }
            switch ($cliente){
                case "info":
                    InfoPersonali();
                    
                    break;
                case "Modifica":
                    Modifica_Profilo();
                    break;
                case "Salva":
                    Aggiorna_Profilo();
                    break;
                default:
                   if (($menu=="profilo")||(($menu=="")&&($elenco=="")&&($job==""))){
                         ClienteProfilo(); 
                     }
                    break;
      
            }
    
            
        break;
    case "giardiniere" :
        if (($menu=="profilo")||(($menu=="")&&($elenco=="")&&($job==""))){
                         GiardiniereProfilo(); 
        }
        break;
    default ://nessun account
        $mansione="cliente"; 
        if ($job=="Registrati"){
            
            FormAggiungiPersonale($mansione);
         }
        if ($job=="Salva"){
            $i=AggiungiPersonale($mansione);
            switch ($i){
                case 0://cliente aggiunto correttamente
                    echo "<h2> Registrazione effettuata </h2>";
                    Login(($_POST['username']), ($_POST['password']));
                    
                    break;
                case 1: //nome utente già utilizzato
                        echo "<p> !!! nome utente già esistente </p>";
                        FormAggiungiPersonale($mansione);
                        break;
                case 2: //la password non combaccia
                    echo "<p> !!! password non corretta </p>";
                    FormAggiungiPersonale($mansione);
                    break;
                case 3: // non sono stati inseriti i campi obligatori
                    echo "<p> !!! non sono stati compilati tutti i campi </p>";
                    FormAggiungiPersonale($mansione);
                    break;
            }
        }
        
        break;

}
    
switch ($job){
    case "Conferma":
        if (isset($_POST['giorno'])){
            FormLavoro($_POST['giorno']);  
        }else{
            if (isset($_GET['specie'])){
                formSpecie ($_GET['specie']); 
            }
       }
        break;
    case "Prenota":
        if (isset($_POST['giorno'])){
            GestionePrenotazione($_POST['attivita'],$_POST['giorno']);
        }
        break;
    case "Visualizza":
            FormVisualizza ($_GET['IDPianta']);
        break;
    case "Acquista":
            formCarrello ($_GET['IDPianta']);
        break;
}
   


if ($elenco!=""){    
    if ($elenco=='0'){
        ElencoPianteTipo(0,$elenco);
    }else{
        ElencoPianteTipo(-1,$elenco);
    }
}

switch ($menu){
    case "piante":
            ElencoPianteTipo(0,0);
        break;
  
    default:
        
        break;
}


?>