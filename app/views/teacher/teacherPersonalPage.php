<div class="widthConstrained" >

    <div align="center">
        <h3><?php echo $this->teacher['firstname'] . ' ' . $this->teacher['lastname'] . ' (' . $this->teacher['username'] . ')';?></h3>

        <h3>Endre e-postadresse</h3>
        <form method="post" action="/teacher/doChangeEmail">
            <p>Nåværende e-post:</p>
            <p><?php echo $this->teacher['email']?></p>
            <input name="email" type="email" placeholder="Ny epost her">
            <br>
           <input type="submit" value="Endre e-postadresse">
        </form>


        <h3>Endre passord</h3>
        <form method="post" action="/teacher/doChangePassword">
            <input name="currentPassword" type="password" placeholder="Nåværende passord">
            <br>
            <input name="newPassword1" type="password" placeholder="Nytt passord">
            <br>
            <input name="newPassword2" type="password" placeholder="Nytt passord igjen">
            <br>
            <input type="submit" value="Endre password">
        </form>

        <br>
        <br>
        <a href="http://larer.salaby.no/">Gå til lærersiden</a>
        <br>
        <br>
        <a href="/teacher">Gå tilbake til dashbord</a>
    </div>


</div>