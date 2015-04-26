Kontaktlærer: <?php echo $this->mainTeacher['firstname'].' '.$this->mainTeacher['lastname']; ?>

<form method="post" action="/schooladmin/addNewPupilToClass">
    <input type="hidden" value="<?php echo $this->classID; ?>" name="classid">
    <input type="text" name="firstname" placeholder="Fornavn">
    <input type="text" name="lastname" placeholder="Etternavn">
    <input type="submit" value="Legg til elev">
</form>
<form method="post" action="/schooladmin/updateMainTeacher">
    <input type="hidden" name="classid" value="<?php echo $this->classID; ?>">
    <select name="mainTeacher">
        <option disabled selected>Velg ny kontaktlærer..</option>
        <?php foreach($this->schoolTeachers as $teacher) { ?>
            <option value="<?php echo $teacher['username']; ?>"><?php echo $teacher['firstname'].' '.$teacher['lastname']; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Oppdater">
</form>

    <table id="classPupils">
        <tr>
            <th>Etternavn</th>
            <th>Fornavn</th>
            <th>Brukernavn</th>
            <th>Passord</th>
            <th>Endre</th>
            <th>Fjern</th>
        </tr>
        <?php foreach($this->classPupils as $pupil) { ?>
            <tr>
                <td><?php echo $pupil['lastname']; ?></td>
                <td><?php echo $pupil['firstname']; ?></td>
                <td><?php echo $pupil['username']; ?></td>
                <td><?php echo $pupil['password']; ?></td>
                <td>Tannhjul</td>
                <td>X</td>
            </tr>
        <?php } ?>
    </table>

