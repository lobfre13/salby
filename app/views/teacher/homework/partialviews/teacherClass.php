
    <table>
        <a href="/teacher/pupilSettings">
            <div id="teacherPropertiesDiv">
            <button type="button" id="propertiesButton"></button>
            <label id="addSchoolTxt">Innstillinger</label>
            </div>
        </a>
        <tr>
            <th>Navn</th>
            <th>Fremgang</th>
        </tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <tr>
                <td><span><?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?></span></td>
                <td><progress value="<?php echo $pupil['progress']; ?>" max="100"></progress></td>
            </tr>
        <?php }?>
    </table>
