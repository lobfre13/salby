
    <table>
        <tr>
            <th>Navn</th>
            <th>Fremgang</th>
        </tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <tr>
                <td><?php echo $pupil['firstname'].' '.$pupil['lastname']; ?></td>
                <td><progress value="<?php echo $pupil['progress']; ?>" max="100"></progress></td>
            </tr>
        <?php }?>
    </table>
