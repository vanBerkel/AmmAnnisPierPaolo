<form action="index.php" method="post">
<fieldset>
    <label>Nome utente*</label>
    <input type="text" name="username"  <?php echo $dis;?> value="<?php echo $personale->getUsername();?>" >
    <br>    
    <label>Password*</label> 
    <input type=<?php echo $type;?> name="password" <?php echo $dis;?> value="<?php echo $personale->getPassword();?>">
    <?php echo $psw;?>
    <br>
    <label>Nome</label>
    <input type="text" name="nome" <?php echo $dis;?> value="<?php echo $personale->getNome();?>">
    <label>Cognome</label>
    <input type="text" name="cognome" <?php echo $dis;?> value="<?php echo $personale->getCognome();?>">
    <br>
    <label>Indirizzo</label>
    <input type="text" name="indirizzo" <?php echo $dis;?> value="<?php echo $personale->getIndirizzo();?>">
    <label>Città</label>
    <input type="text" name="citta" <?php echo $dis;?> value="<?php echo $personale->getCitta();?>">
    <label>Cap</label>
    <input type="text" name="cap" <?php echo $dis;?> value="<?php echo $personale->getCap();?>">
    <br>
    <label>Email</label>
    <input type="text" name="email" <?php echo $dis;?> value="<?php echo $personale->getEmail();?>">
    <label>Telefono*</label>
    <input type="text" name="telefono" <?php echo $dis;?> value="<?php echo $personale->getTelefono();?>">
    <br>
    <input type="submit" <?php echo $uso;?>>
    <input type="hidden" name="inserisci" value="personale">
    <p>*campi obligatori </p>
</fieldset>
</form>
