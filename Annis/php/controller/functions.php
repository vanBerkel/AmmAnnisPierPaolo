<?php
include_once ("php/model/Pianta.php");
include_once ("php/model/Specie.php");
include_once ("php/model/Personale.php");


function AggiornaListaNav(){
        include 'php/view/login/Accedi.php';
}


function Modifica_Profilo(){
    global $db;
    $user = $_SESSION['logged'];
    $q="SELECT * FROM personale WHERE Username='$user'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setPassword($row['Password']);
    $personale->setEmail($row['Email']);
    $personale->setIndirizzo($row['Indirizzo']);
    $personale->setCap($row['Cap']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    $personale->setCitta($row['Citta']);
    $personale->setTelefono($row['Telefono']);
    
    echo "<h2>Modifica i miei dati personali </h2>";
    PagePersonale($personale,1);
    
    
}
/*$tipo = 0 non modificabile
 * >0 modificabile
 * =2 aggiunta 
 * =3 registrazione
 */
function PagePersonale($personale,$tipo){
    if ($tipo>0){
        $dis="";
        $type="password";
        $psw="<label>ripeti password*</label><input type=password name=password2>";
        $uso="name=personale value=Salva";
    }
    if($tipo==0){
        $type="text";
        $dis="disabled";
        $psw="";
        $uso="name=personale value=Modifica";
    }
    if ($tipo==2){  $uso="name=admin value=Inserisci";
    }if ($tipo==3){
        $uso="name=job value=Salva";
    }
        include 'php/view/other/PagePersonale.php';
    
}
function InfoPersonali(){
    global $db;
    $user = $_SESSION['logged'];
    $q="SELECT * FROM personale WHERE Username='$user'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setPassword($row['Password']);
    $personale->setEmail($row['Email']);
    $personale->setIndirizzo($row['Indirizzo']);
    $personale->setCap($row['Cap']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    $personale->setCitta($row['Citta']);
    $personale->setTelefono($row['Telefono']);
  
    echo "<h2>I miei dati personali </h2>";
    PagePersonale($personale,0);
    
}

function Aggiorna_Profilo(){
    global $db;
    if (isset ($_SESSION['logged'])){
        $logged= $_SESSION['logged'];
    }
    else {
        $logged="";
    }
$username = addslashes($_POST['username']);
$passw = addslashes($_POST['password']);
$passw2 = addslashes($_POST['password2']);
if ($passw==$passw2){
    $name = addslashes($_POST['nome']);
    $cognome = addslashes($_POST['cognome']);
    $telefono = addslashes($_POST['telefono']);
    $email = addslashes($_POST['email']);
    $indirizzo = addslashes($_POST['indirizzo']);
    $citta = addslashes($_POST['citta']);
    $cap = addslashes($_POST['cap']);

    if (($username != "") && ($passw != "") && ($telefono != "")) {
    //Controlla se è già esistente
            $unico=0;
            if ($logged!=$username){
                $q = "SELECT * FROM personale
                WHERE Username = '$username'";
                $res = $db->query($q);
                $row = mysql_fetch_array($res);
                $unico = mysql_num_rows($res);
                  
            }
            if ( $unico == 0) {
                $cliente="cliente";
                //inserisce il nuovo utente nell'archivio
                if ($logged!=""){  
                  
                    $qq="SELECT Id FROM personale WHERE Username='$logged'";
                    $resout = $db->query($qq);
                    $resout = mysql_fetch_array($resout);
                    $resout = $resout['Id'];
                    $q = "UPDATE personale SET `Username`='$username',
                            `Password`='$passw', `Citta`='$citta',
                            `Indirizzo`='$indirizzo',`Cap`='$cap',
                            `Telefono`='$telefono',`Email`='$email',
                            `Nome`='$name',`Cognome`='$cognome'
                          WHERE `Id`='$resout'";
                                  
                }else{
                    $q = "INSERT INTO `personale`(`Username`,`Email`,`Indirizzo`,
                        `Citta`,`Cap`,`Password`,`Telefono`,`Nome`,`Cognome`,`Mansione`) 
                        VALUES ('$username','$email','$indirizzo','$citta','$cap',
                        '$passw','$telefono','$name','$cognome','$cliente')";
                }
            
                $res = $db->query($q);
                if ($logged!=""){
                    $_SESSION['logged']=$username;
                    InfoPersonali();
                    ?>
                      <script type="text/javascript">
                          alert('modifiche effettuate!');   
                      </script>
                    <?php
                }else {
                    Login($username, $passw);
                }                   
                   
            } else {
                if ($logged!="")
                    Modifica_Profilo();
                else include ('php/view/login/RegistrazioneVis.php');
            ?>
            <script type="text/javascript">
                alert('nome utente non valido!');   
            </script>
            <?php
            }    
            
            } else 
                {
                    if ($logged!="") Modifica_Profilo();
                    else include ('php/view/login/RegistrazioneVis.php');
                     ?>
                     <script type="text/javascript">
                         alert('nome utente, password, telefono sono campi da compilare obligatoriamente');   
                     </script>
                     <?php
    }

}
else{
    if ($logged!="") Modifica_Profilo();
    else include ('php/view/login/RegistrazioneVis.php');
        ?>
        <script type="text/javascript">
            alert('password non corrispondenti!');   
	</script>
        <?php
}
    
    
}
/*visualizza una pianta
 * $val indice della pianta
 * ritorna un oggetto di tipo pianta
 */
//visualizza una pianta
function Pianta($val){
        global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
    $q = "SELECT * FROM pianta where IdPianta = '$val'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);

    $pianta = new Pianta();
    $pianta->setDescrizione($row['Descrizione']);
    $pianta->setDisponibilita($row['Disponibilita']);
    $pianta->setId($row['IdPianta']);
    $pianta->setImmagine($row['Immagine']);
    $pianta->setNome($row['Nome']);
    $pianta->setPrezzo($row['Prezzo']);
    $pianta->setStagioneFioritura($row['StagioneFioritura']);
    return $pianta;
}
//visualizza una pianta
function FormVisualizza($val){
    $pianta = new Pianta();
    $pianta=Pianta($val);
    $mansione="";
    if(isset($_SESSION['logged'])){
        $mansione=  ReturnMansione($_SESSION['logged']);
    }
    include("php/view/PiantaVis.php");
    
}


//visualizza la specie selezionata
function FormSpecie($val){
    global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
    $q = "SELECT * FROM specie where idSpecie = '$val'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res); 
    $specie = new Specie();
    $specie->setDescrizione($row['Descrizione']);
    $specie->setInfoMetodoColt($row['InfoMetodoColt']);
    $specie->setId($row['IdSpecie']);
    $specie->setImmagine($row['Immagine']);
    $specie->setNome($row['Nome']);
    $specie->setCarEsposizione($row['CarEsposizione']);

    include("php/view/SpecieVis.php");
    ElencoPianteTipo(mysql_num_rows($res),$val);
    
}
/* tipo =0 Seleziona tutte le piante
 * tipo>0 selezione solo le piante di una specie 
 * tipo <0 cerca per lettera
 * val = idSPecie oppure lettera da cercare oppure 0 identifica che siamo in elenco di lettere
 */
function ElencoPianteTipo($tipo,$val){
    global $db;
    $esiste=0;
    echo "<label> Elenco delle piante </label>";
    switch ($tipo){
        case 0 :
            $q = "SELECT * FROM pianta";
            
                include ("php/view/other/ElencoPianteLettera.php");
            
           break;
        case 1:
            $q = "SELECT * FROM pianta where IdSpecieFK = '$val'";
            $esiste=$val;
            break;
        default:
            $q="SELECT * FROM pianta WHERE nome regexp'^[$val]'";
            include ("php/view/other/ElencoPianteLettera.php");
            break;
    }
     
    $res = $db->query($q);

    $piante[mysql_num_rows($res)]= new Pianta();
    $i=0;
    while($row = mysql_fetch_array($res)){
        $piante[$i] = new Pianta();
        $piante[$i]->setDescrizione($row['Descrizione']);
        $piante[$i]->setDisponibilita($row['Disponibilita']);
        $piante[$i]->setId($row['IdPianta']);
        $piante[$i]->setImmagine($row['Immagine']);
        $piante[$i]->setNome($row['Nome']);
        $piante[$i]->setPrezzo($row['Prezzo']);
        $piante[$i]->setStagioneFioritura($row['StagioneFioritura']);
       
        $i++;
    }
    $mansione="";
    if (isset($_SESSION['logged'])){
         $mansione=ReturnMansione($_SESSION['logged']);
    }
    include ("php/view/other/ElencoPiante.php");
}

/* return 0 personale aggiunto
 * 1    nome utente gia esistente
 * 2    password non combaccia
 * 3    non compilati tutti i campi obligatori
 */
function AggiungiPersonale($mansione){
    global $db;
    $ritorno =0;

    $username = addslashes($_POST['username']);
    $passw = addslashes($_POST['password']);
    $passw2 = addslashes($_POST['password2']);
    if ($passw==$passw2){
        $name = addslashes($_POST['nome']);
        $cognome = addslashes($_POST['cognome']);
        $telefono = addslashes($_POST['telefono']);
        $email = addslashes($_POST['email']);
        $indirizzo = addslashes($_POST['indirizzo']);
        $citta = addslashes($_POST['citta']);
        $cap = addslashes($_POST['cap']);

            if (($username != "") && ($passw != "") && ($telefono != "")) {
        //Controlla se è già esistente
                if (ReturnId($username)==NULL) {
                    //inserisce il nuovo utente nell'archivio
                    $q = "INSERT INTO `personale`(`Username`,`Email`,`Indirizzo`,
                        `Citta`,`Cap`,`Password`,`Telefono`,`Nome`,`Cognome`,`Mansione`) 
                        VALUES ('$username','$email','$indirizzo','$citta','$cap',
                            '$passw','$telefono','$name','$cognome','$mansione')";
                    $res = $db->query($q);
                } else{//utente già esistente
                    $ritorno=1;
                }    

            } else {
                 $ritorno=3;
        }
    }
    else{
        $ritorno=2;
    }
    return $ritorno;
}



    







/*!! se si cerca di salvare viene mostrato un messaggio di errore ma se si aggiorna
 * la pagina si torna in index.php
 * cercare di risolvere questo problema
 */
/*???
 * si ritorna sempre alla home 
 */
function Logout(){
    unset($_SESSION['logged']); // toglie il collegamento
    header('Location: index.php');//???cercare una soluzione alternativa il sito riprende dalla home
    
}
/*???
 * si ritorna sempre alla home al posto di rimanere nella stessa pagina 
 */
function Login($username,$passw){
    global $db;
    $q = "SELECT * FROM personale
    WHERE Username = '$username' AND Password ='$passw'";
    $res = $db->query($q);

    if(mysql_num_rows($res) == 1) {
        $row = mysql_fetch_array($res);
        $_SESSION['logged'] = $row['Username']; //è stata trovato username e password corrispondenti
        header('Location: index.php');//???cercare una soluzione alternativa il sito riprende dalla home
    }
    else {?>
        <script type="text/javascript">
                alert('username o password non corretti');   
        </script>
    <?php
    }
}

function AggiornaGiorno(){
    $b = date('Y-m-d');
    $g=86400;
    $w=86400*7;
    $t = time();
    $b = date('Y-m-d',$t+$g);
    $max= date('Y-m-d',$t+$w);
    $pos = date('Y-m-d; G i s',$t);
    include 'php/view/RicercaGiornoForm.php';
}




//contralla quali giardinieri sono liberi il giorno
function FormLavoro($giorno){
    global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
    $mansione = "giardiniere";
    $q = "SELECT * FROM personale WHERE Mansione='$mansione' AND 
            Id NOT IN (SELECT giardiniere_fk FROM giorno WHERE DAY =  '$giorno')";
    $res = $db->query($q);
    if (mysql_num_rows($res) !=0){
        $giardiniere[mysql_num_rows($res)]= new Personale();
        $i=0;
        while($row = mysql_fetch_array($res)){
            // echo $row1['Username'];
             $giardiniere[$i] = new Personale();
             $giardiniere[$i]->setUsername($row['Username']);

    //??mancano dati
             $i++;
        }
        include 'php/view/ListaGiardinieri.php';
    }
    else 
        echo "non ci sono giardinieri disponibili per il ".$giorno;
 }
 
 function GestionePrenotazione($giardiniere, $giorno){
    global $db;
    if ($giardiniere=="null"){
        ?>
        <script type="text/javascript">
            alert('non hai selezionato nessun giardiniere!');   
	</script>
        <?php
        include 'php/view/ListaGiardinieri.php';
    }else{
    if (isset($_SESSION['logged'])){
        $mansione = "giardiniere";
        $g = "SELECT * FROM personale WHERE Username='$giardiniere'";
        $resg=$db->query($g);
        $giar = mysql_fetch_array($resg);
        $giardini = $giar['Id'];
        $clienti = $_SESSION['logged'];
        $c = "SELECT * FROM personale WHERE Username='$clienti'";
        $resc=$db->query($c);
          
        $cl = mysql_fetch_array($resc);
        $cliente=$cl['Id'];
      
        $t= time($giorno);
        $q = "INSERT INTO giorno (`day`,`giardiniere_fk`, `cliente_fk`) 
                VALUES ('$giorno','$giardini', '$cliente')";
                $db->query($q);
        echo "prenotazione effettuata per il giorno ".$giorno;
    }
    else {
        ?>
        <script type="text/javascript">
            alert('devi prima autenticarti!');   
	</script>
        <?php
    }
    }
    
     
 }
 Function SceltaSpecie(){       
    global $db;
    $q = "SELECT * FROM specie"; // estrae tuttii dati dalla tabella post � la tabella
    $res = $db->query($q); //invochiamo  il meotdo query su db
    $specie[mysql_num_rows($res)] = new Specie();
    $i=0;
    while($row = mysql_fetch_array($res)){ //ciclo per estrarre i dati
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    include 'php/view/ListaSpecie.php';
 }        

 //aggiunge al carrello un nuovo articolo
function FormCarrello($prod){
    global $db;
    $cliente = $_SESSION['logged'];
    $q= "UPDATE pianta SET Disponibilita = Disponibilita-1 WHERE IdPianta = '$prod'";
    $res = $db->query($q);
    //ricerca dell'acquirente
    $IdCliente = ReturnId($cliente);
        //ricerca se la pianta è stata già acquistata
    $q = "SELECT * FROM acquisto WHERE cliente_fk='$IdCliente' AND pianta_fk = $prod ";
    $res = $db->query($q);
    if (mysql_num_rows($res)==0){
        $q = "INSERT INTO `acquisto`(`quantita`, `cliente_fk`, `pianta_fk`) 
                VALUES ('1','$IdCliente','$prod')";
    }else{
        $q="UPDATE acquisto SET quantita = quantita+1 where pianta_fk = $prod and cliente_fk=$IdCliente";
       }
    $res = $db->query($q);
    if (isset($_GET['IDSpecie'])){
            FormSpecie($_GET['IDSpecie']);
            
    }else{
        FormVisualizza($prod);
    }
    ?>
        
        <script type="text/javascript">
            alert('pianta acquistata!!');   
	</script>
		
    <?php		
}
 
function ReturnMansione($personale){
    global $db;
    $q ="SELECT * FROM personale WHERE Username='$personale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $mansione = $row['Mansione'];
    return $mansione;
}

function ReturnId($personale){
    global $db;
    $q ="SELECT * FROM personale WHERE Username='$personale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idpersonale = $row['Id'];
    return $Idpersonale;
}
function AggiungiPianta($nome,$descrizione,$disponibilita,$specie, $immagine,$prezzo){
    global $db;
    $q = "INSERT INTO pianta (`Nome`,`Descrizione`, `Disponibilita`,`IdSpecieFK`,
        `Immagine`,`Prezzo`) 
                VALUES ('$nome','$descrizione', '$disponibilita', '$specie','$immagine'
            , '$prezzo')";
    $db->query($q);
}
//cerca pianta per nome è restituisce idPianta se viene trovato altrimenti NULL
function CercaPianta($nome){
    global $db;
    $q ="SELECT * FROM pianta WHERE Nome='$nome'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idpianta = $row['IdPianta'];
    return $Idpianta;   
}
//aggiunge una nuova specie
function AggiungiSpecie($nome,$descrizione){
    global $db;
    $q = "INSERT INTO specie(`Nome`,`Descrizione`) 
                VALUES ('$nome','$descrizione')";
    $db->query($q);
}


//cerca specie per nome è restituisce idSpecie se viene trovato altrimenti NULL
function CercaSpecie($nome){
    global $db;
    $q ="SELECT * FROM specie WHERE Nome='$nome'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idspecie = $row['IdSpecie'];
    return $Idspecie;   
}

function FormAggiungiSpecie(){
    $specie = new Specie();
    $specie->setDescrizione("");
  
    $specie->setNome("");
    include 'php/view/admin/PageSpecie.php';
}

function FormAggiungiPersonale($mansione){
    $i=1;
    $personale = new Personale();
    $personale->setUsername("");
    $personale->setPassword("");
    $personale->setEmail("");
    $personale->setIndirizzo("");
    $personale->setCap(0);
    $personale->setNome("");
    $personale->setCognome("");
    $personale->setCitta("");
    $personale->setTelefono(0);
    if ($mansione=="giardiniere"){
        include 'php/view/admin/PageGiardiniere.php';
        $i=2;
    }
    if ($mansione=="cliente"){
        echo "<h1>Registrazione nuovo cliente</h1>";
        $i=3;
    }
    PagePersonale($personale,$i);
    

   
}

function FormModificaPianta($idPianta){
    global $db;
    $pianta = new Pianta;
    $pianta = Pianta($idPianta);
    $q ="SELECT * FROM pianta WHERE IdPianta=$idPianta";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $idSpecie = $row['IdSpecieFK'];
    $q ="SELECT * FROM specie WHERE IdSpecie NOT IN ($idSpecie)";
    $res = $db->query($q);
    
    
    $specie[mysql_num_rows($res)+1] = new Specie();
    $i =1;
    while ($row = mysql_fetch_array($res)){
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    $q ="SELECT * FROM specie WHERE IdSpecie=$idSpecie";
    $res = $db->query($q); 
    $row = mysql_fetch_array($res);
    $specie[0] = new Specie();
    $specie[0]->setId($row['IdSpecie']);
    $specie[0]->setNome($row['Nome']);
    $id=$idPianta;
    echo "<h1>Modifica di una pianta</h1>";
    include 'php/view/admin/PagePianta.php';
}

function FormAggiungiPianta(){
    global $db;
    $pianta = new Pianta();
    $pianta->setDescrizione("");
    $pianta->setDisponibilita(0);
    
    $pianta->setImmagine("");
    $pianta->setNome("");
    $pianta->setPrezzo("");
    $pianta->setStagioneFioritura("");
    
    $q ="SELECT * FROM specie";
    $res = $db->query($q);
    
    $specie[mysql_num_rows($res)] = new Specie();
    $i =0;
    while ($row = mysql_fetch_array($res)){
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    $id=-1;
    echo "<h1>Inserimento di una nuova pianta</h1>";
    include 'php/view/admin/PagePianta.php';
}

function ModificaPianta($idPianta){
   global $db;
   $nome = $_POST['nome'];
   $descrizione = $_POST['descrizione'];
   $disponibilita = $_POST['disponibilita'];
   $idspecie = $_POST['specie'];
   $img = $_POST['immagine'];
   $prezzo = $_POST['prezzo'];
   $q = "UPDATE pianta SET `Nome`='$nome',`Descrizione`='$descrizione', 
           `Disponibilita`='$disponibilita', `IdSpecieFK`='$idspecie',
          `Immagine`='$img', `Prezzo`='$prezzo' WHERE IdPianta='$idPianta'";
 
    $db->query($q);
 
    
}

function AdminProfilo(){
    PianteFinite();
 include 'php/view/admin/Profilo.php';
    /*    AggiungiPiante();
    ModificaPiante();
    AggiungiGiardiniere();
  */
}

function PianteFinite(){
    global $db;
    $q ="SELECT * FROM pianta WHERE Disponibilita<30";
    $res = $db->query($q);
    
        $piante[mysql_num_rows($res)]= new Pianta();
        $i=0;
        while($row1 = mysql_fetch_array($res)){
            $piante[$i] = new Pianta();
            $piante[$i]->setDescrizione($row1['Descrizione']);
            $piante[$i]->setDisponibilita($row1['Disponibilita']);
            $piante[$i]->setId($row1['IdPianta']);
            $piante[$i]->setImmagine($row1['Immagine']);
            $piante[$i]->setNome($row1['Nome']);
            $piante[$i]->setPrezzo($row1['Prezzo']);
            $piante[$i]->setStagioneFioritura($row1['StagioneFioritura']);
            $i++;
        }
    include 'php/view/admin/PianteEsaurite.php';
    
     

    
}
   

function AdminAggiungiPiante($idPianta,$quant){
    global $db;
    $q ="UPDATE pianta SET `Disponibilita`=Disponibilita+'$quant'
                            WHERE IdPianta='$idPianta'";
    $res = $db->query($q);
}

function ClienteAcquisti($idPersonale){
    global $db;
    $q ="SELECT * FROM acquisto, pianta WHERE cliente_fk=$idPersonale AND pianta_fk=IdPianta";
    $res = $db->query($q);
    
        $piante[mysql_num_rows($res)]= new Pianta();
        $i=0;
        while($row1 = mysql_fetch_array($res)){
            $piante[$i] = new Pianta();
            $piante[$i]->setDescrizione($row1['Descrizione']);
            $piante[$i]->setDisponibilita($row1['quantita']);
            $piante[$i]->setId($row1['IdPianta']);
            $piante[$i]->setImmagine($row1['Immagine']);
            $piante[$i]->setNome($row1['Nome']);
            $piante[$i]->setPrezzo($row1['Prezzo']);
            $piante[$i]->setStagioneFioritura($row1['StagioneFioritura']);
            $i++;
        }
    include 'php/view/cliente/Acquisti.php';
}

function ClienteInfoPersonali($idPersonale){
    global $db;
   
    $q="SELECT * FROM personale WHERE Id='$idPersonale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setPassword($row['Password']);
    $personale->setEmail($row['Email']);
    $personale->setIndirizzo($row['Indirizzo']);
    $personale->setCap($row['Cap']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    $personale->setCitta($row['Citta']);
    $personale->setTelefono($row['Telefono']);
    include 'php/view/cliente/InfoPersonali.php';
}

function ClienteGiardiniere($idPersonale){
    global $db;
    $mansione="giardiniere";
    $b = date('Y-m-d');
    
    $q ="SELECT * 
FROM giorno, personale
WHERE cliente_fk='$idPersonale'
AND DAY >  '$b'
AND giardiniere_fk = Id";
   
    $res = $db->query($q);
   
        $personale[mysql_num_rows($res)]= new Personale();
        $i=0;
        while($row = mysql_fetch_array($res)){
            $personale[$i] = new Personale();
            $personale[$i]->setUsername($row['Username']);
            $personale[$i]->setNome($row['Nome']);

            $personale[$i]->setCognome($row['Cognome']);
            $personale[$i]->setData($row['day']);
            
            $i++;
        }
    include 'php/view/cliente/ClienteGiardiniere.php';
}
function GiardiniereAgenda($idPersonale){
    global $db;
    $personale[7] = new Personale();
    $data=  date('d-m-Y');
    $g=86400;
    
    $t = time();
   
    
    for ($i=0;$i<7;$i++){
        $data = date('d-m-Y',$t+=$g);
        $dg = date('Y-m-d',$t);
        $personale[$i]= new Personale();
        $personale[$i]->setData($data);
        $q="SELECT * 
FROM giorno, personale
WHERE giardiniere_fk='$idPersonale'
AND DAY =  '$dg'
AND cliente_fk = Id ";
        $res = $db->query($q);
        $row = mysql_fetch_array($res);
           
            $personale[$i]->setUsername($row['Username']);
            $personale[$i]->setNome($row['Nome']);
            $personale[$i]->setIndirizzo($row['Indirizzo']);
            $personale[$i]->setTelefono($row['Telefono']);
            $personale[$i]->setCognome($row['Cognome']);
            
    }
    include 'php/view/giardiniere/Agenda.php';
    
}

function GiardiniereProfilo(){
    $personale=$_SESSION['logged'];
    ClienteInfoPersonali(ReturnId($personale));
    GiardiniereAgenda(ReturnId($personale));
}

function ClienteProfilo(){
    $personale=$_SESSION['logged'];
    ClienteInfoPersonali(ReturnId($personale));
    ClienteAcquisti(ReturnId($personale));
    ClienteGiardiniere(ReturnId($personale));
}
    
function VerificaHeaderPersonale(){
    if (isset($_SESSION['logged'])){
        $username=$_SESSION['logged'];
        include 'php/view/personale/header.php';
    }else
    {
        include 'php/view/login/header.php';
    }
    
}


function VerificaNavPersonale(){
    if(isset($_SESSION['logged'])){
        $personale=$_SESSION['logged'];
        $mansione=ReturnMansione($personale);
        if($mansione=="amministratore"){
            include 'php/view/admin/nav.php';
        }
            include 'php/view/other/nav.php';
        
    }else{
            include 'php/view/login/nav.php';
    }
    
 

}
    


function VerificaAsidePersonale(){
    if(isset($_SESSION['logged'])){
        $personale=$_SESSION['logged'];
        $mansione=ReturnMansione($personale);
        if($mansione!="cliente"){
            
        }else{
            SceltaSpecie();
            AggiornaGiorno();
        }
    }else{
        //se non siamo loggati e non siamo nella pagina di registrazione
        //??da aggiungere questa clausola
        SceltaSpecie();
        AggiornaGiorno();
    }
    
 

}
 
 





?> 


