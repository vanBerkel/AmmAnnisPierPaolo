<div id="ElencoPiante">
<?php if ((count($piante)-1)>0){ ?>
<fieldset>
       
        <?php for($count=0;$count<count($piante)-1;$count++){ ?>
                <div class=dettagli>
                <h3><?php echo $piante[$count]->getNome();?> </h3>
	   	<p>Prezzo <?php echo $piante[$count]->getPrezzo(); ?> € 
                <img src="images/<?php echo $piante[$count]->getImmagine(); ?>"/>
                <?php if($piante[$count]->getDisponibilita()==0) { ?></p>
                <p>NON DISPONIBILE 
                 <?php }else{ ?>
                    <br>Disponibilità
                        <?php echo $piante[$count]->getDisponibilita(); }?>
                </p>
        <?php if ($mansione=="amministratore"){ include 'php/view/admin/ModificaPianta.php'; } else {  ?>   
                <form method="get" action="index.php">
			
                    <input type="submit" name="job" value="Visualizza" /><br>
                        <?php if((!$piante[$count]->getDisponibilita()==0)&&($mansione=="cliente")) { ?>
                                <input type="submit" name="job" value="Acquista" />
                        <?php } ?>
			<input type="hidden" name="IDPianta" value="<?php echo $piante[$count]->getId(); ?>" /> 
                        <input type="hidden" name="IDSpecie" value="<?php echo $esiste; ?>" />
                </form>
        <?php } ?>
            </div>
        <?php } ?>
    </fieldset>
<?php } else { ?>
<p>non ci sono piante </p>
<?php } ?>
</div>


