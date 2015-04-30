<div id="content" class="widthConstrained">

    <h3>Dine elever</h3>
    <h3>Velg klasse</h3>
    <select>
        <option></option>
    </select>

    <table>
        <tr>
            <th>Etternavn</th>
            <th>Fornavn</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($this->pupils as $pupil) { ?>
        <tr>
            <td><?php echo $pupil['lastname']; ?></td>
            <td><?php echo $pupil['firstname']; ?></td>
            <td><div class="editButton"></td>
            <td><div class="deleteButton"></td>
            <td><?php } ?></td>
        </tr>
    </table>
</div>