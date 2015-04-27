<div id="content" class="widthConstrained">
    <form method="post" action="/admin/doGetSearchResults">
        <input type="text" name="searchBox">
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
        <tr>
            <?php foreach ($this->schools as $school) { ?>
                <td><?php echo $school['name']?></td>
                <td><?php echo $school['fylke']?></td>
                <td><?php echo $school['kommune']?></td>
                <td><?php echo $school['regkey']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
            <?php } ?>
        </tr>
    </table>
</div>