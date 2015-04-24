<table>
    <tr>
        <th>Oppgave</th>
        <th>Frist</th>
        <th>Endre</th>
        <th>Slett</th>
    </tr>
    <?php foreach($this->tasks as $task) { ?>
        <tr>
            <td><a href="<?php echo $task['url']; ?>"><?php echo $task['title'] ?></a></td>
            <td><?php echo date('Y-m-d', strtotime($task['duedate'])); ?></td>
            <td onclick="editTask(<?php echo $task['id'];?>)">Tannhjul</td>
            <td onclick="deleteTask(<?php echo $task['id'];?>, this)">X</td>
        </tr>
    <?php }?>
</table>