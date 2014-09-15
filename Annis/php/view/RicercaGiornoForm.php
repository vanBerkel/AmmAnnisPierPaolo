<form action="index.php" method="post">
    <fieldset>
    <label> Scegli giorno per la manutenzione del tuo giardino</label><br>
    <input type="date" name="giorno" 
           min="<?php echo $b;?>" 
           value="<?php echo $b;?>"
           />
    <input type="submit" name="job" value="Conferma"/>
    </fieldset>
</form>