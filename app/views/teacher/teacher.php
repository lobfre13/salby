<script>
    function loadClass(sel){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("classPupils").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","/teacher/getClass/"+sel.value, true);
        xmlhttp.send();
    }

</script>
    <div id="content" class="widthConstrained">
        <a class="mainTeacherNavLinks" href="/teacher/addtask/">Legg til Gjøremål</a>
        <a class="mainTeacherNavLinks" href="/teacher/pupilsettings/">Innstillinger for elever</a>
        <a class="mainTeacherNavLinks" href="/teacher/teacherpages/">Lærerside</a>


        <div>
            <label>Velg klasse
                <select onchange="loadClass(this)">
                    <option disabled selected>Velg klasse..</option>
                    <?php foreach($this->schoolClasses as $class) { ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Velg oppgave
                <select>
                    <option></option>
                </select>
            </label>
        </div>

        <div id="classPupils" class="classStats"></div>
        <div class="classStats"></div>




    </div>

