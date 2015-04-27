<div id="content" class="widthConstrained">
    <table>
        <tr>
            <td>Tittel</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
        <tr>
            <?php foreach ($learningObjects as $learningObject) { ?>
                <td><?php echo $learningObject['title']?></td>
                <td><?php echo $learningObject['imgurl']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
            <?php } ?>
        </tr>
        <!--
        <tr>
            <td>Læringsobjekt</td>
            <td>Bilde-url</td>
            <td>Legg til</td>
        </tr>
        -->
    </table>
</div>