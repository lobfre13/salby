<h4>Valgte objekter</h4>
<ul>
    <?php
        foreach($this->pendingTasks as $task){
            echo '<li>'.$task['title'].'</li>';
        }
    ?>
</ul>