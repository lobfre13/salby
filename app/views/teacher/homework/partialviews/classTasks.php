<table>
    <div id="teacherAddHomeworkDiv" onclick="addHomework()">
        <button type="button" id="homeworkAddButton"></button>
        <label id="addSchoolTxt">Legg til gjøremål</label>
    </div>
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
            <td onclick="editTask(<?php echo $task['id'];?>)"> <div class="editButton"></div></td>
            <td onclick="deleteTask(<?php echo $task['id'];?>, this)"> <div class="deleteButton"></div></td>
        </tr>
    <?php }?>
</table>