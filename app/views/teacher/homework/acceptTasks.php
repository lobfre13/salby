<div id="content" class="widthConstrained">
    <span class="addTaskIndicator">Lekseliste</span>
    <span class="addTaskIndicator" >Velg elev</span>
    <span class="addTaskIndicator" style="background-color: #00BFD5">Godkjenn</span>

    <div class="choosePupils">
        <?php include 'pendingTasks.php'; ?>
    </div>

    <div class="choosePupils">
        <h4>Valgte Elever</h4>
        <form method="post" action="/teacher/doAddTasks">
            <input type="hidden" name="classid" value="<?php echo $this->classid; ?>">
            <?php foreach($this->pupils as $pupil) { ?>
                <input readonly checked type="checkbox" name="pupils[]" value="<?php echo $pupil['username']; ?>"> <?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?><br>
            <?php }?>
            <input type="submit" value="VIRKELIG AKSEPTER">
        </form>

    </div><br>

</div>