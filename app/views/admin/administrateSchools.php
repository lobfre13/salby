<div id="content" class="widthConstrained">
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
            <?php foreach ($schools as $school) { ?>
                <td><?php echo $school['name']?></td>
                <td><?php echo $school['fylke']?></td>
                <td><?php echo $school['kommune']?></td>
                <td><?php echo $school['regkey']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
            <?php } ?>
        </tr>
        <!--
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Legg til</td>
        </tr>
        -->
    </table>
</div>