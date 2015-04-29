<script src="/public/javascript/teacherHomework.js"></script>
<div id="content" class="widthConstrained">
    <span class="addTaskIndicator">Lekseliste</span>
    <span class="addTaskIndicator" >Velg elever</span>
    <span class="addTaskIndicator" style="background-color: #00BFD5">Godkjenn</span>

    <div class="choosePupils">
        <?php include 'partialviews/pendingTasks.php'; ?>
    </div>

    <div class="choosePupils">
        <h4>Valgte Elever</h4>
        <form id="accept" method="post" action="/teacher/doAddTasks">
            <input type="hidden" name="classid" value="<?php echo $this->classid; ?>">
            <?php foreach($this->pupils as $pupil) { ?>
                <input type="hidden" name="pupils[]" value="<?php echo $pupil['username']; ?>">
                <input disabled checked type="checkbox"> <?php echo $pupil['firstname'] . ' ' . $pupil['lastname']; ?><br>
            <?php }?>
        </form>

    </div><br>
    <a class="navBtns" href="/teacher/choosePupils/">Tilbake</a>
    <span id="next" class="navBtns" onclick="submitForm('#accept')">Godkjenn</span>

</div>