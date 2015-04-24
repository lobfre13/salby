<h4><?php echo $this->task['title']; ?></h4>
<form action="/teacher/updateTask" method="post">
    <input type="hidden" value="<?php echo $this->task['id']; ?>" name="taskid">
    <label>Dato
        <input type="date" value="<?php echo date('Y-m-d', strtotime($this->task['duedate'])); ?>" name="date">
    </label>
    <input type="submit">
</form>