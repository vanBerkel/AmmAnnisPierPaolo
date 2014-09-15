<ul> 
    <li> 
        <fieldset text="Collegati" >
            <p> Collegati per accedere al servizio </p>
            <form action="index.php" method="post">
                <label>Username</label>
                <input type="text" name="username" />
                <br>
                <label>Password</label>
                <input type="password" name="password"/>
                <br>
                <input type="submit" name="job" value="Login" />
            </form>

            <form action="index.php" method="get">
                <label>Sei un nuovo cliente? </label>
                <input type="submit" name="job" value="Registrati"/>
            </form>
        </fieldset>
    </li>
</ul>