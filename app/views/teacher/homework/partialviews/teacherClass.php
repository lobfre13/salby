
    <table>
        <tr>
            <th>Navn</th>
            <th>Fremgang</th>
        </tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <tr>
                <td><?php echo $pupil['firstname'].' '.$pupil['lastname']; ?></td>
                <td><?php echo $pupil['progress']; ?></td>
            </tr>
        <?php }?>
    </table>
