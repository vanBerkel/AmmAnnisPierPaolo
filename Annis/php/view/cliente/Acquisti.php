<div id="Acquisti">
    <h1>Il mio viale</h1>
<table name="acquisti">
    
    <?php if (count($piante)-1>0){?>
        <tr><th>Nome</th><th>Prezzo</th>
            <th>Quantita</th>
        </tr>
    <?php 
        for($count=0;$count<count($piante)-1;$count++){
                 //ciclo per estrarre i dati
        ?>
    
        <tr><td><?php echo $piante[$count]->getNome();?> </td>
        
            <td> <?php echo $piante[$count]->getPrezzo(); ?> € </td>
            <td> <?php echo $piante[$count]->getDisponibilita();?></td>
            
        </tr>   

        <?php
    }
    
        }else {
        ?>
        <p>Non hai acquistatato nessuna pianta </p><?php } ?>
    </table>
</div>