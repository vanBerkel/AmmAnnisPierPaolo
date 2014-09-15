<h1><?php echo $pianta->getNome(); ?></h1> <?php//campo dato?>
<div class="dettagli">
    <p>
    <img src="images/<?php echo $pianta->getImmagine();?>" style="width:200px;"/> <?php//campo dato?>
    <?php echo $pianta->getDescrizione(); ?></p> <?php//campo dato?> </p>
    <dt> Esemplari disponibili: <?php echo $pianta->getDisponibilita(); ?> </dt>
    <dt> Prezzo: <?php echo $pianta->getPrezzo(); ?> € </dt>
    <form method="get" action="index.php">
        <?php if((($pianta->getDisponibilita()>0))&&($mansione=="cliente")) { ?>
        <input type="submit" name="job" value="Acquista" />
        <?php }
        //considera un unico id ?>
        <input type="hidden" name="IDPianta" value="<?php echo $pianta->getId(); ?>" /> 
    </form> 
</div>