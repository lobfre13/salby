<table>
    <tr>
        <th>Gjøremål</th>
        <th>Frist</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($this->tasks as $task) { ?>
        <tr>
            <td><a href="<?php echo $task['url']; ?>"><?php echo $task['title'] ?></a></td>
            <td><?php echo date('Y-m-d', strtotime($task['duedate'])); ?></td>
            <td onclick="editTask(<?php echo $task['id'];?>)"> <div class="editButton">TANNHJUL</div></td>
            <td onclick="deleteTask(<?php echo $task['id'];?>, this)"> <div class="deleteButton">XXX</div></td>
        </tr>
    <?php }?>
</table>