<form method="get" action="index.php">
<fieldset>
    <label> Cerca Pianta per Specie</label><br>
    <select name="specie">
        <option value="null"> -- Scegli La Specie -- </option>
        <?php 
         for($count=0;$count<count($specie)-1;$count++){
        ?>
        <option value="<?php echo $specie[$count]->getId(); ?>"><?php echo $specie[$count]->getNome();?></option>
          <?php
        }
        ?>
    </select>
    <input type="submit" name="job" value="Conferma"/>
</fieldset>
</form>