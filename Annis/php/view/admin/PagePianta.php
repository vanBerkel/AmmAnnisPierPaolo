<div id="PagePianta">
    
    <fieldset>
    <form method="post" action="index.php">
        <label> Nome </label><br>
        <input type="text" value="<?php echo $pianta->getNome(); ?>"name="nome">
        <br><label>Specie </label>
        <br><select name="specie">
                    <?php for($count=0;$count<count($specie)-1;$count++){ ?>
                 <option value="<?php echo $specie[$count]->getId(); ?>"><?php echo $specie[$count]->getNome();?></option>
                   <?php } ?>
        </select><br>
        <label>Descrizione</label><br>
        <textarea name="descrizione"><?php echo $pianta->getDescrizione(); ?></textarea>
        <br>
        <label>Immagine*</label>
        <br><input type="text" value="<?php echo $pianta->getImmagine(); ?>"name="immagine">
        <br><label>Disponibilita</label>
        <br><input type="text" value="<?php echo $pianta->getDisponibilita(); ?>"name="disponibilita">
        <br><label>Prezzo</label>
        <br><input type="text" value="<?php echo $pianta->getPrezzo(); ?>"name="prezzo">
        <br><input type="submit" name="admin" value="Inserisci"/>
       <input type="hidden" name="inserisci" value="pianta">
       <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p>compila tutti i campi</p>
        <p>*scrivi il nome dell'immagine file.estensione presente nella cartella images</p>
    </form> 
</fieldset>
</div>