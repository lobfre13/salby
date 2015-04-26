<script>

</script>
<div id="content" class="widthConstrained">
    <span class="addTaskIndicator">Lekseliste</span>
    <span class="addTaskIndicator" style="background-color: #00BFD5">Velg elev</span>
    <span class="addTaskIndicator">Godkjenn</span>

    <div class="choosePupils">
        <?php include 'partialviews/pendingTasks.php'; ?>
    </div>

    <div class="choosePupils">
        <h4>Velg Elever</h4>
        <span onclick="markAll();">Merker alle</span>
        <form method="post" action="/teacher/acceptTasks">
            <input type="hidden" value="<?php echo $this->classid; ?>" name="classid">
            <?php foreach($this->pupils as $pupil) { ?>
            <input type="checkbox" name="pupils[]" value="<?php echo $pupil['username']; ?>"> <?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?><br>
            <?php }?>
            <input type="submit" value="Velg akkuratt disse elevene">
        </form>

    </div><br>

</div>