<div id="ClienteGiardiniere">
    <h1>Io e il Giardiniere</h1>
    <?php if ((count($personale)-1)>0){ ?>
    <table name="ClienteGiardiniere">
        <tr><th>Giorno</th><th>Nome</th>
            <th>Cognome</th><th>Nome Utente</th>
        </tr>
        <?php 
        for($count=0;$count<count($personale)-1;$count++){
                 //ciclo per estrarre i dati
            ?><tr>
        <td> <?php echo $personale[$count]->getData();?></td>
        <td><?php echo $personale[$count]->getNome(); ?></td>
        <td> <?php echo $personale[$count]->getCognome();?></td>
        <td><?php echo $personale[$count]->getUsername();?> </td>
        </tr>
        <?php } ?> 
    </table>
    <?php }else { ?>
    <p>Nessuna prenotazione</p>
    <?php } ?>
</div>