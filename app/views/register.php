
    <div id="content" class="widthConstrained signup">


       <a href="/"> <img id="loginLogo" src="/public/img/SALABY_Logo_Orange.png"></a><br>
        <?php
            if($regSuccess){
                echo "<p style=\"color:green;\">Registrering fullført!</p>";
            }
        ?>
        <h3>Registrer som:</h3>
        <a class="regtype" href="#school">Skole</a>
        <a class="regtype" href="#teacher">Lærer</a>
        <a class="regtype" href="#reguser">Vanlig bruker</a>

        <div id="school" class="signupType">
            <form method="post">
               <label>Brukernavn:</label><br> <input type="text" name="username"><br>
               <label>Passord:</label> <br><input type="password" name="password"><br>
                <label>Bekreft Passord:</label><br> <input type="password" name="password"><br>
                <label>E-post:</label> <br><input type="text" name="email"><br>
                <label>Skolenavn:</label> <br> <input type="text" name="schoolname"><br>
                <input type="hidden" name="regtype" value="school">
                <input type="submit" value="Registrer!">
            </form>
        </div>

        <div id="teacher" class="signupType">
            <form method="post">
                <label>Brukernavn:</label><br> <input type="text" name="username"><br>
                <label>Passord:</label> <br><input type="password" name="password"><br>
                <label>Bekreft Passord:</label><br> <input type="password" name="password"><br>
                <label>E-post:</label> <br><input type="text" name="email"><br>
                <label>Skolenøkkel:</label> <br> <input type="text" name="schoolkey"><br>
                <input type="hidden" name="regtype" value="teacher">
                <input type="submit" value="Registrer!">
            </form>
        </div>

        <div id="reguser" class="signupType">
            <form method="post">
                <label>Brukernavn:</label><br> <input type="text" name="username"><br>
                <label>Passord:</label> <br><input type="password" name="password"><br>
                <label>Bekreft Passord:</label><br> <input type="password" name="password"><br>
                <label>E-post:</label> <br><input type="text" name="email"><br>
                <input type="hidden" name="regtype" value="user">
                <input type="submit" value="Registrer!">
            </form>
        </div>

    </div>