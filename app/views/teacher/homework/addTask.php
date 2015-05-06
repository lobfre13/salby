<script src="/public/javascript/teacherHomework.js">showbtn();</script>

<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <span class="addTaskIndicator" style="background-color: #959595">Lekseliste</span>
    <span class="addTaskIndicator">Velg elever</span>
    <span class="addTaskIndicator">Godkjenn</span>

    <div id="sideBar">
        <div id="teacherClasses">
            <input id="selectedClass" type="hidden">
            <h4>Dine Klasser</h4>
            <ul>
                <?php foreach($this->schoolClasses as $class) { ?>
                    <li onclick="loadSubjectCategories(<?php echo $class['subjectid'].','.$class['id']; ?>); loadPending(<?php echo $class['subjectid']; ?>); markSelected(this)"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div id="addTaskContent">
        <div id="chosen"> </div>
        <div id="tasksContent"></div>
        <a class="navBtns" href="/">Tilbake</a>
        <span id="next" class="navBtns" onclick="nextStep()">Gå videre</span>
    </div>


</div>