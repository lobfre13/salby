<script src="/public/javascript/teacherHomework.js"></script>
    <div id="content" class="widthConstrained">
        <a class="mainTeacherNavLinks" href="/teacher/addtask/">Legg til Gjøremål</a>
        <a class="mainTeacherNavLinks" href="/teacher/pupilsettings/">Innstillinger for elever</a>
        <a class="mainTeacherNavLinks" href="/teacher/teacherpages/">Lærerside</a>


        <div>
            <h3>Dine klasser</h3>
            <label>Velg klasse
                <select onchange="loadClass(this); loadClassTasks(this)">
                    <option disabled selected>Velg klasse..</option>
                    <?php foreach($this->schoolClasses as $class) { ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></option>
                    <?php } ?>
                </select>
            </label>
        </div>

        <div id="classPupils" class="classStats"></div>
        <div id="classTasks" class="classStats"></div>




    </div>

