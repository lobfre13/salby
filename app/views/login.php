
        <div id="loginBox">
            <a id="loginLogo" href="/" tabindex="-1"><img id="desktopLogo" src="/public/img/SALABY_Logo_Orange.png"><img id="mobileLogo" src="/public/img/logo_orange.png"></a><br>
            <p>Velkommen til Salaby.no!<br> For å få tilgang til innhold må du logge inn</p>

            <form method="post" id="login" action="/login/login">
                <p style="color:red;"> <?php if($this->failedLogin)echo "Feil Brukernavn eller passord!"; ?></p>
                <label>Brukernavn:<br>
                <input type="text" name="username" placeholder="Brukernavn/Epost" tabindex="1"/></label><br>
                <label>Passord:<br>
                <input type="password" name="password" placeholder="Passord" tabindex="2"/></label><br>
                <input id="loginSubmit" type="submit" value="Logg Inn" tabindex="3"/>
            </form>
            <br>
            <a href="#" tabindex="-1">Glemt Passord?</a>   <a href="/register" tabindex="-1">Opprett ny bruker</a>
            <br><br>
            <a id="nonLogin" href="#" tabindex="-1">Fortsett uten innlogging --></a>
        </div>
