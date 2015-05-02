<table>
    <a href="/teacher/addtask/"> <div id="teacherAddHomeworkDiv">
        <button type="button" id="homeworkAddButton"></button>
        <label id="addSchoolTxt">Legg til gjøremål</label>
    </div></a>
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
            <td>
                <div onclick="editTask(<?php echo $task['id']; ?>)" class="editButton"></div>
                <div onclick="deleteTask(<?php echo $task['id']; ?>, this)" class="deleteButton"></div>
            </td>
        </tr>
    <?php }?>
</table>