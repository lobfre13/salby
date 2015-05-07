<script src="/public/javascript/teacherHomework.js"></script>
<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <span class="addTaskIndicator">Lekseliste</span>
    <span class="addTaskIndicator" style="background-color: #959595">Velg elever</span>
    <span class="addTaskIndicator">Godkjenn</span>

    <div class="choosePupils">
        <?php include 'partialviews/pendingTasks.php'; ?>
    </div>

    <div class="choosePupils">
        <h4>Velg Elever</h4>
        <span onclick="markAll();">Merker alle</span>
        <form id="choosePupils" method="post" action="/teacher/acceptTasks">
            <input type="hidden" value="<?php echo $this->classid; ?>" name="classid">
            <?php foreach($this->pupils as $pupil) { ?>
            <input type="checkbox" name="pupils[]" value="<?php echo $pupil['username']; ?>"> <?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?><br>
            <?php }?>
        </form>

    </div><br>

    <a class="navBtns" href="/teacher/addtask/">Tilbake</a>
    <span id="next" class="navBtns" onclick="submitForm('#choosePupils')">Velg elever</span>

</div>