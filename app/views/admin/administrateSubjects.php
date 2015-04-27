<div id="content" class="widthConstrained">
    <table>
        <tr>
            <td>Fag</td>
            <td>Klassetrinn</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
        <tr>
            <?php foreach ($subjects as $subject) { ?>
                <td><?php echo $subject['subjectname']?></td>
                <td><?php echo $subject['classlevel']?></td>
                <td><?php echo $subject['imgurl']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
            <?php } ?>
        </tr>
    </table>
</div>