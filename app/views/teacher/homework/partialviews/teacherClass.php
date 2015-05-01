
    <table>
        <div id="teacherPropertiesDiv" onclick="properties()">
            <button type="button" id="propertiesButton"></button>
            <label id="addSchoolTxt">Innstillinger</label>
        </div>
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
