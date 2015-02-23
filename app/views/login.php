    <div id="loginBoxWrapper">
        <div id="loginBoxBG"></div>
        <div id="loginBox">
            <a href="/"><img id="loginLogo"></a><br>
            <form method="post" id="login">
                <p>Velkommen til Salaby.no!<br> For å få tilgang til innhold må du logge inn</p>
                <?php
                    if($failedLogin){
                        echo "<p style=\"color:red;\">Feil Brukernavn eller passord!</p>";
                    }
                ?>
                <label>Brukernavn:</label><br>
                <input type="text" name="username" value="Brukernavn/Epost" onfocus="if (this.value == 'Brukernavn/Epost') { this.value = '';}"/><br>
                <label>Passord:</label><br>
                <input type="password" name="password" value="passord" onfocus="if (this.value == 'passord') { this.value = '';}"/><br>
                <input id="loginSubmit" type="submit" value="Logg Inn"/>
            </form>
            <br><br>
            <a href="#">Glemt Passord?</a>   <a href="/register">Opprett ny bruker</a>
            <br><br>
            <a id="nonLogin" href="#">Fortsett uten innlogging -->></a>
        </div>
	</div>
