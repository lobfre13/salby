<h4>Valgte objekter</h4>
<?php if(!arrayEmpty($this->pendingTasks)) {?>
<table id="pendingTasksTable">
    <tr>
        <th>Objekt</th>
        <th>Fjern</th>
    </tr>
    <?php foreach($this->pendingTasks as $task){ ?>
            <tr>
            <td><?php echo $task['title']; ?></td>
                <td><div class="deleteButton" onclick="deletePendingTask(this, '<?php echo $task['learningobjectid']?>', <?php echo $task['pendinghomeworkclassid']?>)"></div></td>
                </tr>
       <?php  } }
        else
            echo 'Ingen valgte objekter..'; ?>



</table>
