
    <table>
        <tr>
            <th>Navn</th>
        </tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <tr>
                <td><?php echo $pupil['firstname'].' '.$pupil['lastname']; ?></td>
            </tr>
        <?php }?>
    </table>
