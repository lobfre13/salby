<div class="widthConstrained" >

    <h1 id="adminPersonalPageHeadline"><?php echo $this->teacher['firstname'] . ' ' . $this->teacher['lastname'] . ' (' . $this->teacher['username'] . ')';?></h1>

    <div id="centerMyContent">

        <div id="emailDiv" class="adminPersonalBox">
            <h3>E-post</h3>
            <form method="post" action="/admin/doChangeEmail">
                <p id="currentEmail"><?php if (empty($this->teacher['email'])) { echo 'Ingen e-postadresse satt enda.'; } else {echo $this->teacher['email'];} ?></p>
                <h3>Endre e-postadresse</h3>
                <input name="email" type="email" placeholder="Skriv inn ny e-post..." class="smoothInputField" required>
                <br>
                <input class="submit" type="submit" value="Endre">
            </form>
        </div>


        <div id="passwordDiv" class="adminPersonalBox">
            <h3>Endre passord</h3>
            <form method="post" action="/admin/doChangePassword">
                <input name="currentPassword" type="password" placeholder="Nåværende passord..." class="smoothInputField" required>
                <br>
                <input name="newPassword1" type="password" placeholder="Nytt passord..." class="smoothInputField" required>
                <br>
                <input name="newPassword2" type="password" placeholder="Gjenta passord..." class="smoothInputField" required>
                <br>
                <input class="submit" type="submit" value="Endre">
            </form>
        </div>
    </div>
    <a id="returnToMainPage" href="/admin"><img src="/public/img/pil.png" width="15px">Tilbake til forside</a>
    <a id ="learningPages" href="http://larer.salaby.no/" >Gå til Salaby's lærersider<img src="/public/img/pil.png" width="15px"></a>
</div>