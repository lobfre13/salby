<div id="content" class="widthConstrained">
    <table>
        <tr>
            <td>Fag</td>
            <td>Klassetrinn</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
        <?php foreach ($this->subjects as $subject) { ?>
        <tr>
            <td><?php echo $subject['subjectname']?></td>
            <td><?php echo $subject['classlevel']?></td>
            <td><img src=<?php echo'"' . $subject['imgurl'] . '"'?></td>
            <td>RedigerSymbol</td>
            <td>SlettSymbol</td>
        </tr>
            <?php } ?>
    </table>
    <input type = "submit" value="Opprett fag">
</div>