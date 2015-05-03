<div class="widthConstrained" >

    <h1><?php echo $this->admin['firstname'] . ' ' . $this->admin['lastname'] . ' (' . $this->admin['username'] . ')';?></h1>


    <div id="emailDiv">
        <h3>Endre e-postadresse</h3>
        <form method="post" action="/admin/doChangeEmail">
            <p><?php if (empty($this->admin['email'])) { echo 'Ingen e-postadresse satt enda.'; } else {echo $this->admin['email'];} ?></p>
            <input name="email" type="email" placeholder="Skriv inn ny e-post...">
            <br>
            <input type="submit" value="Endre">
        </form>
    </div>


    <div id="passwordDiv">
        <h3>Endre passord</h3>
        <form method="post" action="/admin/doChangePassword">
            <input name="currentPassword" type="password" placeholder="Nåværende passord...">
            <br>
            <input name="newPassword1" type="password" placeholder="Nytt passord...">
            <br>
            <input name="newPassword2" type="password" placeholder="Gjennta passord...">
            <br>
            <input type="submit" value="Endre">
        </form>
    </div>
    <br>
    <br>
    <a href="/admin">Tilbake til forside</a>
    <a href="/admin">Gå til Salaby's lærersider</a>
</div>