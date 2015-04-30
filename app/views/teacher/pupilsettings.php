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
            <td><?php echo $pupil['etternavn']; ?></td>
            <td><?php echo $pupil['fornavn']; ?></td>
            <td>edit</td>
            <td>delete</td>
            <td><?php } ?></td>
        </tr>
    </table>
</div>