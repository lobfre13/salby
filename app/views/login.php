
        <div id="loginBox">
            <a href="/"><img id="loginLogo"></a><br>
            <form method="post" id="login" action="/login/login">
                <p>Velkommen til Salaby.no!<br> For å få tilgang til innhold må du logge inn</p>

                <p style="color:red;"> <?php if($this->failedLogin)echo "Feil Brukernavn eller passord!"; ?></p>

                <label>Brukernavn:<br>
                <input type="text" name="username" value="Brukernavn/Epost" onfocus="if (this.value == 'Brukernavn/Epost') { this.value = '';}" onblur="if (this.value == '') { this.value = 'Brukernavn/Epost';}"/></label><br>
                <label>Passord:<br>
                <input type="password" name="password" value="passord" onfocus="if (this.value == 'passord') { this.value = '';}" onblur="if (this.value == '') { this.value = 'passord';}"/></label><br>
                <input id="loginSubmit" type="submit" value="Logg Inn"/>
            </form>
            <br>
            <a href="#">Glemt Passord?</a>   <a href="/register">Opprett ny bruker</a>
            <br><br>
            <a id="nonLogin" href="#">Fortsett uten innlogging --></a>
        </div>
