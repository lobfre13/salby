<div id="content" class="widthConstrained">
    <?php include 'partialviews/topLinks.php'; ?>

    <h2>Opprett ny lærer</h2>
    <form method="post" action="/schooladmin/registerNewTeacher">
        <input required type="text" name="firstname" placeholder="Fornavn"><br>
        <input required type="text" name="lastname" placeholder="Etternavn"><br>
        <input required type="email" name="email" placeholder="Epost"><br>
        <input required type="text" name="username" placeholder="Brukernavn"><br>
        <input required type="password" name="password" placeholder="Passord"><br>
        <input type="submit" value="Legg til lærer">
    </form>

</div>