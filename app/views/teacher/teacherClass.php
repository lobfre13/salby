<table>
    <tr>
        <td>Navn:</td>
    </tr>
    <tr>
        <?php foreach($this->pupils as $pupil) { ?>
            <td><?php echo $pupil['name']; ?></td>
        <?php }?>
    </tr>
</table>