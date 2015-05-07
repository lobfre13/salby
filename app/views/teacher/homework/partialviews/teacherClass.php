
    <table>
        <a href="/teacher/pupilSettings">
            Elevopplysninger <img src="/public/img/rediger.png" width="20">
        </a>
        <tr>
            <th>Navn</th>
            <th>Fremgang</th>
        </tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <tr>
                <td><?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?></td>
                <td><progress value="<?php echo $pupil['progress']; ?>" max="100"></progress></td>
            </tr>
        <?php }?>
    </table>
