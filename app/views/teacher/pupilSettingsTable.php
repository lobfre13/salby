
    <tr>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Brukernavn</th>
        <th>Passord</th>
    </tr>
    <?php foreach ($this->pupils as $pupil) { ?>
    <tr>
        <td><?php echo $pupil['firstname']; ?></td>
        <td><?php echo $pupil['lastname']; ?></td>
        <td><?php echo $pupil['username']; ?></td>
        <td><?php echo $pupil['password']; ?></td>
    </tr>
    <?php } ?>
