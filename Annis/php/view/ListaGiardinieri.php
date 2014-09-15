<form method="post" action="index.php">
    <fieldset>
        <label> Scegli Giardiniere disponibile per il <?php echo $giorno;?></label><br>
        <select name="attivita">
            <option value="null" disabled>----</option>
            <?php 
            for($count=0;$count<count($giardiniere)-1;$count++){
               ?>
            <option value="<?php echo $giardiniere[$count]->getUsername(); ?>">
              <?php echo $giardiniere[$count]->getUsername(); ?>
            </option>
              <?php
            }?>
        </select>
        <input type="submit" name="job" value="Prenota"/>
        <input type="hidden" name="giorno" value="<?php echo $giorno;?>"/>
            
    </fieldset>
</form>