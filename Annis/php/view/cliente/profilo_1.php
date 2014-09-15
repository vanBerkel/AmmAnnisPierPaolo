<h1> Elenco delle piante che stanno finendo </h1>
<fieldset>
    <table>
        <tr><th>Nome</th><th>Prezzo</th><th>disponibilita'</th>
            <th>Quantita</th>
        <th>Aggiungi</th></tr>
    <?php 
        for($count=0;$count<count($piante)-1;$count++){
                 //ciclo per estrarre i dati
        ?>
    
        <tr><td><?php echo $piante[$count]->getNome();?> </td>
        
            <td> <?php echo $piante[$count]->getPrezzo(); ?> € </td>
            <td> <?php echo $piante[$count]->getDisponibilita();?></td>
            
	   
                <form method="post" action="index.php">
                    <td>	
                        <select name="quant"> 
                            <option value="0"> -- </option>
                            <option value="5"> 5</option>
                            <option value="10"> 10 </option>
                            <option value="15"> 15 </option>
                            <option value="20"> 20 </option>
                            <option value="25"> 25 </option>
                            <option value="30"> 30 </option>
                            
                        </select>
                    </td><td>
                    <input type="submit" name="admin" value="Aggiungi" />    
                    <input type="hidden" name="IDPianta" value="<?php echo $piante[$count]->getId(); ?>" /> 
                        </td>
                </form>
    </tr>
            
        <?php
        }?>
    </table>
</fieldset>

