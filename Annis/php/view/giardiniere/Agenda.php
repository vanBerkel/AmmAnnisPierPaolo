<table>
    <tr><th>Giorno</th><th>Nome</th><th>Cognome</th><th>Indirizzo</th><th>Telefono</th></tr>
    <?php for($count=0;$count<(7);$count++){ ?>
            <tr>
                <td><?php echo $personale[$count]->getData();?></td>
                <td><?php echo $personale[$count]->getNome();?></td>
                <td><?php echo $personale[$count]->getCognome();?></td>
                <td><?php echo $personale[$count]->getIndirizzo();?></td>
                <td><?php echo $personale[$count]->getTelefono();?></td>
            </tr>
    <?php } ?>
</table>