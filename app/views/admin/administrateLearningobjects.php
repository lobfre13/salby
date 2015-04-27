<div id="content" class="widthConstrained">
    <table>
        <tr>
            <?php foreach ($learningObjects as $learningObject) { ?>
                <td><?php echo $school['title']?></td>
                <td><?php echo $school['imgurl']?></td>
                <td>Rediger</td>
                <td>Slett</td>
            <?php } ?>
        </tr>
        <tr>
            <td>Læringsobjekt</td>
            <td>Bilde-url</td>
            <td>Legg til</td>
        </tr>
    </table>
</div>