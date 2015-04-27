<div id="content" class="widthConstrained">
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
            <td>Rediger</td>
            <td>Slett</td>
        </tr>

            <?php foreach ($this->schools as $school) { ?>
        <tr>
                <td><?php echo $school['name']?></td>
                <td><?php echo $school['fylke']?></td>
                <td><?php echo $school['kommune']?></td>
                <td><?php echo $school['regkey']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
        </tr>
            <?php } ?>
    </table>
</div>