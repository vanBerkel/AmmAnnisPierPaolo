<div id="PageSpecie">
    <h1>Inserimento di una nuova specie</h1>
    <fieldset>
    <form method="post" action="index.php">
        <label> Nome </label><br>
        <input type="text" value="<?php echo $specie->getNome(); ?>"name="nome">

        <br>
        <label>Descrizione</label><br>
        <textarea name="descrizione"><?php echo $specie->getDescrizione(); ?></textarea>
        
        <br>
        <br><input type="submit" name="admin" value="Inserisci"/>
        <input type="hidden" name="inserisci" value="specie">
       
        <p>compila tutti i campi</p>
       
    </form> 
</fieldset>
</div>