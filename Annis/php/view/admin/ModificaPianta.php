<form method="post" action="index.php">
    <input type="submit" name="admin" value="Modifica" />
    <input type="hidden" name="modifica" value="pianta" />
    <input type="hidden" name="IDPianta" value="<?php echo $piante[$count]->getId(); ?>" /> 
</form> 
