<div id="content" class="widthConstrained">
    <form method="post" action="/admin/addSchool">
        <input type="submit" value="Legg til skole">
    </form>
    <form method="post" action="/admin/doGetSchoolSearchResults">
        <input type="text" name="searchBoxSchools">
        <input type="submit" value="Søk her...">
    </form>
    <table>
        <tr>
            <td>Skolenavn</td>
            <td>Fylke</td>
            <td>Kommune</td>
            <td>Registreringsnøkkel</td>
        </tr>

        <tr>
            <form>
                <td><input type="text" name="skolenavn" value="Skolenavn"></td>
                <td><input type="text" name="skolenavn" value="Fylke"></td>
                <td><input type="text" name="skolenavn" value="Kommune"></td>
                <td><input type="text" name="skolenavn" value="Registreringsnøkkel"></td>
                <td>Rediger/Slett/leggtil</td>
            </form>
        </tr>
        <?php foreach ($this->schools as $school) { ?>
            <tr>
                <td><?php echo $school['name'] ?></td>
                <td><?php echo $school['fylke'] ?></td>
                <td><?php echo $school['kommune'] ?></td>
                <td><?php echo $school['regkey'] ?></td>
                <td><img src="/public/img/redigerIkon.png"></td>
                <td><img src="/public/img/slettIkon.png"></td>
            </tr>
        <?php } ?>
    </table>
</div>