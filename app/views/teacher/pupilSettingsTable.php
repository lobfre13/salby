
    <tr>
        <th>Etternavn</th>
        <th>Fornavn</th>
        <th>Brukernavn</th>
        <th>Passord</th>
        <th>E-post</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($this->pupils as $pupil) { ?>
    <tr>
        <td><?php echo $pupil['lastname']; ?></td>
        <td><?php echo $pupil['firstname']; ?></td>
        <td><?php echo $pupil['username']; ?></td>
        <td><?php echo $pupil['password']; ?></td>
        <td><?php echo $pupil['email']; ?></td>
    </tr>
    <?php } ?>
