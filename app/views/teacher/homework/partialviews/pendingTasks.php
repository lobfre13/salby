<h4>Valgte objekter</h4>
<ul>
    <?php
        foreach($this->pendingTasks as $task){ ?>
            <li><?php echo $task['title']; ?></li>
       <?php  }
        if(!arrayEmpty($this->pendingTasks))
            echo '<input type="button" onclick="nextStep()" value="GÅ VIDERE">';
         else echo 'Ingen valgte objekter..';
        ?>
</ul>
